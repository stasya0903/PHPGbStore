<?php


namespace App\controllers;

use App\services\renders\IRender;
use App\services\Request;




abstract class CRUDController extends Controller
{
    protected $nameSingle = "";
    protected $namePlr = "";
    protected $namePlrInRus = "";
    protected $render;
    protected $service;
    protected $repository;

    abstract public function getRepository():object ;
    abstract public function getService():object;

    /**
     * @param IRender $render
     * @param Request $request
     */

    public function __construct(IRender $render, Request $request)
    {
        parent::__construct($render, $request);
        $this->repository = $this->getRepository();
        $this->service = $this->getService();
    }

    public function allAction()
    {
        return $this->render("$this->namePlr", [
            "$this->namePlr" => ($this->repository)->getAll(),
            'title' => "Все $this->namePlrInRus"
        ]);
    }

    public function oneAction()
    {
        return $this->render("$this->nameSingle", [
            "$this->nameSingle" => ($this->repository)->getOne($this->getId()),
            'title' => 'Name'
        ]);
    }

    public function addToDBAction()
    {
        if ($this->isPost()) {
            ($this->service)->fillUser($this->request->post());

            return header("Location:/$this->nameSingle");
        }

        return $this->render($this->nameSingle . "Add");
    }

    public function updateAction()
    {
        if (empty($this->getId())) {
            return header("Location: /$this->nameSingle");
        }

        $item = $this->repository->getOne($this->getId());

        if ($this->isPost()) {
            $this->service->fillUser($this->request->post(), $item);
            return header("Location: /$this->nameSingle");
        }

        return $this->render($this->nameSingle . 'Update', [$this->nameSingle => $item]);
    }

    protected function render($template, $params = [])
    {
        return $this->render->render($template, $params);
    }

    protected function getId()
    {
        return (int)$this->request->get('id');
    }

    protected function isPost()
    {
        return $this->request->isPost();
    }


}