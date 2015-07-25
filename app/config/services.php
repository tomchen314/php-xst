<?php

/**
 * Services are globally registered in this file
 */

use Phalcon\DI\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\Router;

/**
 * Read configuration
 */
$config = include __DIR__ . "/config.php";

$loader = new \Phalcon\Loader();
/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
    array(
        'Xst\Core' => ROOT_PATH . '/app/core/',
        'Xst\Models' => ROOT_PATH . '/app/models/',
        'Xst\Libraries' => ROOT_PATH . '/app/libraries/',
        'Xst\Plugins' => ROOT_PATH . '/app/plugins/',
	)
)->register();

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

$di['logger'] = function () use ($config) {
    $logger = new \Phalcon\Logger\Adapter\File($config->application->logger->file);
    $logger->setFormatter(new $config->application->logger->format());
    return $logger;
};

/**
 * Registering a router
 */
$di['router'] = function () use($config) {

    $router = new Router();

    $router->setDefaultModule($config->application->defaultModule);
    $router->setDefaultNamespace('Xst\Modules\\' . ucfirst($config->application->defaultModule) . '\Controllers');
    
//    // router for skeleton
//    $router->add("/?([a-zA-Z0-9_-]*)/?([a-zA-Z0-9_]*)(/.*)*",
//            array(
//                "namespace"=>"Multi\Modules\Skeleton\Controllers",
//                "module"=>"skeleton",
//                "controller"=>1,"action"=>2,"params"=>3));

    // router for multi
    foreach ($config->application->modules as $module) {
        $router->add("/(". $module->rootRouter .")/?([a-zA-Z0-9_-]*)/?([a-zA-Z0-9_]*)(/.*)*",
            array(
                "namespace" => 'Xst\Modules\\' . ucfirst($module->module) . '\Controllers',
                "module" => $module->module,
                "controller"=>2,"action"=>3,"params"=>4
            )
        );
    }

    return $router;
};

$di->set('flash', function(){
	return new FlashSession(
        array(
		    'error'   => 'alert alert-danger',
		    'success' => 'alert alert-success',
		    'notice'  => 'alert alert-info',
	    )
    );
});

/**
 * Start the session the first time some component request the session service
 */
$di['session'] = function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
};

$di['db'] = function () use ($config) {
    $adapter = '\Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    return new $adapter(
        array(
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname,
            "port"   => $config->database->port,
            "charset" => $config->database->charset
        )
    );
};