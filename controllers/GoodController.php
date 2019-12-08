<?php


namespace App\controllers;


use App\modules\Good;
use App\modules\User;

class GoodController
{
    protected $defaultAction = 'all';


    public function run($actionName)
    {
        if (empty($actionName)) {
            $actionName = $this->defaultAction;

        }
        if (!empty ($_POST)){

            $actionName = "addToDB";
        }

        $method = $actionName . 'Action';

        if(method_exists($this, $method)) {

            return $this->$method();
        }
        header('Location:?');
    }

    public function allAction()
    {
        $goods = ($user = new Good())->getAll();
        return $this->render("goods",["goods" => $goods,
            'title'=>$user->id,
            'id'=>$user->id]);

    }

    public function oneAction()
    {

        if (empty($_GET['id'])){
            $this->allAction();
        }
        $id = ($_GET['id']);

        $good = ($oGood = new Good())->getOne($id);
        return $this->render('good',  ['good'=>$good,
            'title'=>$good->id,
            'id'=>$good->id]);

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

    public function deleteFromDBAction ()
    {
        if (empty($_GET['id'])){
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $id = $_GET['id'];
        $good = new Good;
        $good->id = $id;
        $good->delete();

        header('location: ' . $_SERVER['HTTP_REFERER']);

    }

    public function addToDBAction ()
    {
        $good = new Good;

        if (!empty($_GET['id'])){
            $good->id=$_GET['id'];
        }

        if(!empty($_FILES)){

            $this->uploadPic();
            $good->img_dir = $_FILES['userfile']['name'];
        }
        foreach ($_POST as $property => $value)
        {
            if (empty($value)){
                continue;
            }
            $good->$property=$value;
        }

        $good->save();
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }


    private function uploadPic(){
        $file = dirname(__DIR__ ). "/public/img/". $_FILES['userfile']['name'];
        copy($_FILES['userfile']['tmp_name'],$file);
    }



}