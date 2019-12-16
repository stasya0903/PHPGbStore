<?php


namespace App\services\CRUD;


class DeleteFromDB extends GlobalVarsServices
{

    public function delete ($model, $modelName)
    {
        if (!$id = $this->getID())
        {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $item = $model;
        $item->id = $id;
        $item->delete();

        header("location:?c=" . $modelName );

    }
}