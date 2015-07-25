<?php
/**
 * Created by PhpStorm.
 * User: tang
 * Date: 2015/07/20
 * Time: 14:46
 */

namespace Xst\Core;

use \Phalcon\Forms\Form;

abstract class FormBase extends Form {

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array()) {
    }

    public function getElementByName($name) {
        return $this->_elements[$name];
    }
}