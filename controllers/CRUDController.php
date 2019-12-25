<?php


namespace App\controllers;

use App\services\CRUDServices;
use App\services\renders\IRender;
use App\services\renders\TmpRender;
use App\services\Request;

class CRUDController extends Controller
{
    protected $model;
    protected $modelName = "";
    protected $nameSingle = "";
    protected $namePlr ="";
    protected $render;
    protected $CRUDServices;


    /**
     *
     * @param IRender $render
     * @param Request $request
     */


    public function __construct(IRender $render, Request $request )
    {
        parent::__construct($render, $request);
        $this->model = new $this->modelName;
        $this->CRUDServices = new CRUDServices();

    }
    public function allAction()
    {
       return  $this->CRUDServices->all($this->model,$this->render, $this->namePlr);
    }
    public function oneAction()
    {
       return  $this->CRUDServices->one($this->model,$this->render, $this->request, $this->nameSingle);
    }

    public function addToDBAction ()
    {
       return  $this->CRUDServices->addToDB($this->request,$this->render,$this->model, $this->nameSingle);
    }

    public function deleteFromDBAction ()
    {
        $this->CRUDServices->delete($this->model, $this->request, $this->nameSingle);
    }

    protected function render($template, $params = [])
    {
        return   $this->render->render($template, $params);
    }



}