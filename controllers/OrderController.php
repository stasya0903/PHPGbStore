<?php


namespace App\controllers;
use App\modules\Order;

class OrderController extends CRUDController
{
    public $modelName = Order::class;
    public $nameSingle = "order";
    public $namePlr = "orders";


    public function createAction()
    {
        if (!$this->request->isPost()){
            return $this->render('createOrder');
        }

        $this->CRUDServices->addToDB($this->request, $this->render,$this->model,$this->nameSingle);
        $this->request->unsetInSession("good");


    }
}