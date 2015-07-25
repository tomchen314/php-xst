<?php
/**
 * Created by PhpStorm.
 * User: tang
 * Date: 2015/07/20
 * Time: 15:04
 */

namespace Xst\Modules\Skeleton\Controllers;

use Xst\Core\ControllerBase;

class ProductController extends ControllerBase {

    /**
     * Index action
     */
    public function productListAction() {
        parent::callAction();
    }

    /**
     * Displayes the creation form
     */
    public function newProductAction() {
        parent::callAction();
    }

    /**
     * Deletes a product
     *
     * @param string $id
     */
    public function deleteAction() {
        parent::callAction();
    }
}