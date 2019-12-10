<?php


namespace App\controllers;
use App\modules\User;


class UserController extends CRUDController
{
    public $modelName = User::class;
    public $item = "user";


}