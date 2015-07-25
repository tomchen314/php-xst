<?php
/**
 * Created by PhpStorm.
 * User: tang
 * Date: 2015/07/20
 * Time: 15:07
 */

namespace Xst\Modules\Skeleton\Controllers\Product;

use Xst\Modules\Skeleton\Forms\Product\NewProductForm;
use Xst\Models\Products;
use Xst\Core\ActionBase;

class NewProductAction extends ActionBase {

    private $productId = 0;

    protected function do_Load()
    {
        // get params
        $params = $this->dispatcher->getParams();
        if (is_array($params) && isset($params[0])) {
            $this->productId = $params[0];
        }
        // first load
        if (!$this->request->isPost()) {
            $this->loadData();
        }
        // postback
        else {
            $this->view->form = new NewProductForm();
        }
    }

    private function loadData() {
        if ($this->productId > 0) {

            $product = Products::findFirstByid($this->productId);
            if (!$product) {
                $this->view->form = new NewProductForm();
                $this->flash->error("product was not found");
                return;
            }

            $this->view->form = new NewProductForm($product);
        }
        else {
            $this->view->form = new NewProductForm();
        }
    }

    protected function do_save() {
        if ($this->productId > 0) {
            $product = Products::findFirstByid($this->productId);
        }
        else {
            $product = new Products();
        }

        $product->setProductTypesId($this->request->getPost("product_types_id"));
        $product->setName($this->request->getPost("name"));
        $product->setPrice($this->request->getPost("price", "float"));
        //$product->setActive($this->request->getPost("active"));

        if (!$product->save()) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }

            return;
        }

        if ($this->productId > 0) {
            $this->view->form->getElementByName("test")->setDefault("10");
            $this->tag->setDefault("test", "11");
            $this->flash->success("product was created successfully"."test");
            return;
        }
        else {
            $this->flashSession->success("product was created successfully");
            return $this->response->redirect("product/productList");
        }
    }

    /**
     * Deletes a product
     *
     * @param string $id
     */
    public function do_delete() {
        $this->logger->log($this->productId);
        $product = Products::findFirstByid($this->productId);
        if (!$product) {
            $this->flash->error("product was not found");
            return $this->response->redirect("product/productList");
        }

        if (!$product->delete()) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->response->redirect("product/productList");
        }

        $this->flash->success("product was deleted successfully");
        return $this->response->redirect("product/productList");
    }
}