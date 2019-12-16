<?php


namespace App\services\CRUD;


abstract class GlobalVarsServices
{
    protected function getID () {
        if (empty($_GET['id'])) {
            return false;
        }
        return $_GET['id'];
    }

    protected function uploadPic(){
        if(empty($_FILES)) {
            return false;
        }
        $file = dirname(__DIR__ ). "/public/img/". $_FILES['userfile']['name'];
        copy($_FILES['userfile']['tmp_name'],$file);
        return $_FILES['userfile']['name'];
    }

    protected function getPostArray()
    {
        return $_POST;
    }
}