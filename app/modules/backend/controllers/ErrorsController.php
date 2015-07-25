<?php
namespace Xst\Modules\Backend\Controllers;

use Phalcon\Mvc\Controller;

class ErrorsController extends Controller {
    public function initialize() {
        $this->tag->setTitle('Oops!');
        //parent::initialize();
    }
    public function show404Action() {
    }
    public function show401Action() {
    }
    public function show500Action() {
    }
}