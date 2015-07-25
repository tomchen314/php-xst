<?php
/**
 * Created by PhpStorm.
 * User: tang
 * Date: 2015/07/25
 * Time: 10:02
 */

namespace Xst\Core;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;
use Xst\Plugins\NotFoundPlugin;

abstract class ModuleBase implements ModuleDefinitionInterface {

    /**
     * Current module name.
     *
     * @var string
     */
    protected $_moduleName = "";

    /**
     * Current module name.
     *
     * @var string
     */
    protected $_baseUri = "";

    /**
     * Registers the module auto-loader
     *
     * @param \Phalcon\DI $di
     */
    public function registerAutoloaders(\Phalcon\DiInterface $di=null) {
        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'Xst\Modules\\' . ucfirst($this->_moduleName) . '\Controllers' => ROOT_PATH . '/app/modules/' . $this->_moduleName .'/controllers/',
                'Xst\Modules\\' . ucfirst($this->_moduleName) . '\Forms' => ROOT_PATH . '/app/modules/' . $this->_moduleName .'/forms/',
            )
        );
        $loader->register();
    }

    /**
     * Registers the module-only services
     *
     * @param \Phalcon\DI $di
     */
    public function registerServices(\Phalcon\DiInterface $di) {
        /**
         * We register the events manager
         */
        $di->set('dispatcher', function() use ($di) {
            $eventsManager = new EventsManager;
            /**
             * Check if the user is allowed to access certain action using the SecurityPlugin
             */
            //$eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);
            /**
             * Handle exceptions and not-found exceptions using NotFoundPlugin
             */
            $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
            $dispatcher = new Dispatcher;
            $dispatcher->setDefaultNamespace('Xst\Modules\\' . ucfirst($this->_moduleName) . '\Controllers');
            $dispatcher->setModuleName($this->_moduleName);
            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        });

        /**
         * Setting up the view component
         */
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir(ROOT_PATH . '/app/modules/' . $this->_moduleName .'/views/');

            $view->registerEngines(
                array(
                    '.volt' => function ($view, $di) {
                        $volt = new VoltEngine($view, $di);

                        $volt->setOptions(
                            array(
                                'compiledPath' => ROOT_PATH . '/app/modules/' . $this->_moduleName .'/cache/',
                                'compiledSeparator' => '_'
                            )
                        );
                        $compiler = $volt->getCompiler();
                        $compiler->addFunction('is_a', 'is_a');

                        return $volt;
                    },
                    '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
                )
            );

            return $view;
        };

        $di['url'] = function () {
            $url = new UrlResolver();
            $url->setBaseUri($this->_baseUri);

            return $url;
        };
    }
}