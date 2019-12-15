<?php
namespace App\services;


class Request
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;
    protected $params;
    protected $session;


    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->params = [
            'get' => $_GET,
            'post' => $_POST,
        ];
        $this->parseRequest();
    }

    protected function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
        }
    }

    public function get($params = '')
    {
        if (empty($params)) {
            return $this->params['get'];
        }

        if (!empty($this->params['get'][$params])) {
            return $this->params['get'][$params];
        }

        return array();
    }

    /**
     * @return mixed
     */
    public function getRequestString()
    {
        return $this->requestString;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }
}

