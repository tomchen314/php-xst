<?php

use Phalcon\Mvc\Application;

error_reporting(E_ALL);

try {

    /**
     * Versions.
     */
    define('MULTI_VERSION', '0.0.1');
    define('PHALCON_VERSION_REQUIRED', '2.0.0');
    define('PHP_VERSION_REQUIRED', '5.5.0');

    /**
     * Check phalcon framework installation.
     */
    if (!extension_loaded('phalcon')) {
        printf('Install Phalcon framework %s', PHALCON_VERSION_REQUIRED);
        exit(1);
    }

    /**
     * Pathes.
     */
    define('DS', DIRECTORY_SEPARATOR);
    if (!defined('ROOT_PATH')) {
        define('ROOT_PATH', dirname(dirname(__FILE__)));
    }
    if (!defined('PUBLIC_PATH')) {
        define('PUBLIC_PATH', dirname(__FILE__));
    }

    /**
     * Include services
     */
    require ROOT_PATH . '/app/config/services.php';

    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Include modules
     */
    require ROOT_PATH . '/app/config/modules.php';

    echo $application->handle()->getContent();
} catch (Exception $e) {
    echo $e->getMessage();
}
