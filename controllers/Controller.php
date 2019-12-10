<?php


namespace App\controllers;


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

    protected function render($template, $params=[])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl('layouts/main', ['content'=>$content]);
    }
    protected function renderTmpl($template, $params=[])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}