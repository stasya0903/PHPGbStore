<?php


namespace App\controllers;
use App\services\renders\IRender;
use App\services\renders\TmpRender;

abstract class Controller
{
    protected $defaultAction = 'all';

    public function run($actionName)
    {

        if (empty($actionName)) {
            $actionName = $this->defaultAction;
        }

        $method = $actionName . 'Action';

        if(method_exists($this, $method)) {

            return $this->$method();
        }

        header('Location:?');
    }

    protected function render($template, $params = [])
    {
        return $this->render->render($template, $params);
    }


}