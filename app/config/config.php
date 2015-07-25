<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return new \Phalcon\Config(
    array(
        'database' => array(
            'adapter'  => 'Mysql',
            'host'     => '192.168.50.4',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'invo',
            'port'     => '3306',
            'charset'  => 'utf8',
        ),
        'application' => array(
            'baseUri' => '/php-xst/',
            'defaultModule' => 'skeleton',
            'modules' => array(
                array(
                    'module' => 'backend',
                    'rootRouter' => 'admin',
                    ),
                ),
            'logger' => array(
                'file' => ROOT_PATH .'/app/logs/test.log',
                'format' => '\Phalcon\Logger\Formatter\Json',
             ),
         )
    )
);