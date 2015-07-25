<?php

namespace Xst\Modules\Backend\Controllers\Product;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Xst\Models\Products;
use Xst\Core\ActionBase;

class ProductListAction extends ActionBase {

    public function doAction()
    {
        parent::doAction();
    }

    protected function do_Load()
    {
        $this->persistent->parameters = null;
        $this->view->page = null;
        if ($this->request->isGet()) {
            $this->do_search();
        }
    }

    /**
     * Searches for products
     */
    protected function do_search()
    {
        $numberPage = 1;
        $this->_search($numberPage);
    }

    protected function do_chngPage($numberPage)
    {
        $this->_search($numberPage);
    }

    private function _search($numberPage)
    {
        $query = Criteria::fromInput($this->di, 'Xst\Models\Products', $_POST);
        $this->persistent->parameters = $query->getParams();

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $products = Products::find($parameters);
        if (count($products) == 0) {
            $this->flash->notice("The search did not find any products");

            return;
        }

        $paginator = new Paginator(array(
            "data" => $products,
            "limit"=> 3,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
        $pageList = array();
        for ($i = 1; $i <= $this->view->page->total_pages; $i++) {
            if ($i != $numberPage) {
                $pageList[] = $i;
            }
        }
        $this->view->pageList = $pageList;
    }
}