<?php
/**
 * Created by PhpStorm.
 * User: tang
 * Date: 2015/07/20
 * Time: 11:37
 */

namespace Xst\Core;

use \Phalcon\Mvc\Controller;

abstract class ControllerBase extends Controller {

    public function indexAction() {
        $this->callAction();
    }

    protected function callAction() {
        $nsNm = $this->dispatcher->getNamespaceName();
        $moduleNm = $this->dispatcher->getModuleName();
        $ctrllerNm = $this->dispatcher->getControllerName();
        $actionNm = $this->dispatcher->getActionName();
        require ROOT_PATH . '/app/modules/' . $moduleNm . '/controllers/'.$ctrllerNm."/".$actionNm."Action.php";
        $actionClsNm = $nsNm."\\".$ctrllerNm."\\".$actionNm."Action";
        $actionCls = new $actionClsNm();
        $this->logger->log($actionClsNm);
        $actionCls->doAction();
    }

    protected function forward($uri) {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
        return $this->dispatcher->forward(
            array(
                'controller' => $uriParts[0],
                'action' => $uriParts[1],
                'params' => $params
            )
        );
    }
}