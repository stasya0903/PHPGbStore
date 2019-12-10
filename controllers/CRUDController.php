<?php


namespace App\controllers;


use App\modules\Good;

class CRUDController extends Controller
{
    protected $model;
    protected $modelName = "";
    protected $item = "";

    public function __construct()
    {
        $this->model = new $this->modelName;
    }
    public function allAction()
    {
        $items = $this->model->getAll();
        return $this->render("{$this->item}s", ["{$this->item}s" => $items]);
    }
    public function oneAction()
    {
        if (!$id = $this->getID())
        {
            $this->allAction();
        }
        $item = $this->model->getOne($id);
        return $this->render("$this->item", ["$this->item" => $item]);
    }

    public function addToDBAction ()
    {
        if($_SERVER['REQUEST_METHOD'] != "POST") {

            return $this->render($this->item."Add");
        }

        $item = $this->model;
        $item->id = $this->getID();

        if (!empty ($_FILES)){
            $item->img_dir = $this->uploadPic();
        }

        $propertyToUpdate = $_POST;

        foreach ($propertyToUpdate as $property => $value)
        {
            if (empty($value)){
                continue;
            }
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
        $file = dirname(__DIR__ ). "/public/img/". $_FILES['userfile']['name'];
        copy($_FILES['userfile']['tmp_name'],$file);
        return $_FILES['userfile']['name'];
    }
}