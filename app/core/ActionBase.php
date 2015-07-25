<?php
/**
 * Created by PhpStorm.
 * User: tang
 * Date: 2015/07/20
 * Time: 11:41
 */

namespace Xst\Core;

abstract class ActionBase extends ControllerBase {

    public function doAction() {
        $methodNm = "do_Load";
        $this->$methodNm();
        if($this->request->isPost())
        {
            $eventTarget = "do_".$this->request->getPost("__EVENTTARGET");
            $eventArgs = $this->request->getPost("__EVENTARGUMENT");
            $this->$eventTarget($eventArgs);
        }
    }
}