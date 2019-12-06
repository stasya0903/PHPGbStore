<?php


namespace App\controllers;
use App\modules\User;


class UserController
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

    public function allAction()
    {
        $users = ($user = new User())->getAll();
        return $this->render("users",["users" => $users]);

    }

    public function oneAction()
    {

        if (empty($_GET['id'])){
            $this->allAction();
        }
        $id = ($_GET['id']);

        $user = ($oUser = new User)->getOne($id);
        return $this->render('user',  ['user'=>$user,
                                                'title'=>$user->id]);

    }

    public function render($template, $params=[])
    {
      $content = $this->renderTmpl($template, $params);
      return $this->renderTmpl('layouts/main', ['content'=>$content]);
    }
    public function renderTmpl($template, $params=[])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }

}