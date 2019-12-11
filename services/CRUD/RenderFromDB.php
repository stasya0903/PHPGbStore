<?php


namespace App\services\CRUD;


class RenderFromDB extends GlobalVarsServices
{
    public function all($model,$render,$item)
    {
        $items = $model->getAll();
        return $render->render("{$item}s", ["{$item}s" => $items]);
    }
    public function one($model,$render,$item)
    {

        if (!$id = $this->getID())
        {
            $this->allAction();
        }

        $item = $model->getOne($id);
        return $render->render("$item", ["$item" => $item]);
    }
}