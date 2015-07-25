<?php

/**
 * Read configuration
 */
$config = include __DIR__ . "/config.php";

/**
 * Register application modules
 */
$modules = array();
$modules[$config->application->defaultModule] = array(
    'className' => 'Xst\Modules\\' . ucfirst($config->application->defaultModule) . '\Module',
    'path' => ROOT_PATH . '/app/modules/' . $config->application->defaultModule . '/Module.php'
);

foreach ($config->application->modules as $module) {
    $modules[$module->module] = array(
        'className' => 'Xst\Modules\\' . ucfirst($module->module) . '\Module',
        'path' => ROOT_PATH . '/app/modules/' . $module->module . '/Module.php'
    );
}
$application->registerModules($modules);
