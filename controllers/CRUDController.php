<?php


namespace App\controllers;


use App\modules\Good;
use App\services\renders\IRender;
use App\services\renders\TmpRender;

class CRUDController extends Controller
{
    protected $model;
    protected $modelName = "";
    protected $item = "";
    protected $render;

    public function __construct(IRender$render)
    {
        $this->render = $render;
        $this->model = new $this->modelName;
    }
    public function allAction()
        //TODO  create separte service
    {
        $items = $this->model->getAll();
        return $this->render("{$this->item}s", ["{$this->item}s" => $items]);
    }
    public function oneAction()
    {
        //TODO  create separte service
        if (!$id = $this->getID())
        {
            $this->allAction();
        }

        $item = $this->model->getOne($id);
        return $this->render("$this->item", ["$this->item" => $item]);
    }

    public function addToDBAction ()
    {
        //TODO  create separte service
        if($_SERVER['REQUEST_METHOD'] != "POST") {

            if ($id = $this->getID()) {
                $item = ($this->model)->getOne($id);
                return $this->render($this->item."Update", ["user"=>$item]);
            }

            return $this->render($this->item."Add");
        }

        $item = $this->model;

        if ($img_dir = $this->uploadPic()){
            $item->img_dir = $img_dir;
        }
        if ($id = $this->getID()){
            $item->id = $id ;
        }

        $propertyToUpdate = $this->getPostArray();

        foreach ($propertyToUpdate as $property => $value)
        {
            if ($value == 'password'){
                $item->$property =  password_hash($propertyToUpdate['password'], PASSWORD_DEFAULT);
                continue;
            }
            $item->$property = $value;
        }

        $item->save();

        header("location:?c=" . $this->item );
    }

    public function deleteFromDBAction ()
    {
        //TODO  create separte service
        if (!$id = $this->getID())
        {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $item = $this->model;
        $item->id = $id;
        $item->delete();

        header("location:?c=" . $this->item );

    }

    protected function getID () {
        if (empty($_GET['id'])) {
            return false;
        }
        return $_GET['id'];
    }

    private function uploadPic(){
        if(empty($_FILES)) {
            return false;
        }
        $file = dirname(__DIR__ ). "/public/img/". $_FILES['userfile']['name'];
        copy($_FILES['userfile']['tmp_name'],$file);
        return $_FILES['userfile']['name'];
    }

    private function getPostArray()
    {
        return $_POST;
    }
}