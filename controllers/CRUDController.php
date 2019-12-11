<?php


namespace App\controllers;


use App\modules\Good;
use App\services\renders\IRender;
use App\services\renders\TmpRender;
use App\services\CRUD\DeleteFromDB;
use App\services\CRUD\AddToDB;
use App\services\CRUD\RenderFromDB;

class CRUDController extends Controller
{
    protected $model;
    protected $modelName = "";
    protected $item = "";
    protected $render;
    protected $delete;
    protected $add;
    protected $renderFromDB;
    /**
     * @var DeleteFromDB
     */


    public function __construct(IRender$render)
    {
        $this->render = $render;
        $this->model = new $this->modelName;
        $this->delete = new DeleteFromDB();
        $this->add = new AddtoDB();
        $this->renderFromDB = new RenderFromDB();

    }
    public function allAction()
    {
       return  $this->renderFromDB->all($this->model,$this->render, $this->item);
    }
    public function oneAction()
    {
       return  $this->renderFromDB->one($this->model,$this->render, $this->item);
    }

    public function addToDBAction ()
    {
        $this->delete->delete($this->model, $this->item);
    }

    public function deleteFromDBAction ()
    {
        $this->delete->delete($this->model, $this->item);
    }

    protected function render($template, $params = [])
    {
        return $this->render->render($template, $params);
    }



}