<?php


namespace App\controllers;
use App\modules\User;


class UserController extends CRUDController
{
    public $modelName = User::class;
    public $nameSingle = "user";
    public $namePlr = "users";


}