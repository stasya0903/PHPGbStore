<?php


namespace App\services\CRUD;


class AddToDB extends GlobalVarsServices
{
    public function addToDBAction ($model, $modelName)
    {
        if($_SERVER['REQUEST_METHOD'] != "POST") {

            if ($id = $this->getID()) {
                $item = ($model)->getOne($id);
                return $this->render($modelName."Update", ["user"=>$item]);
            }

            return $this->render($modelName."Add");
        }

        $item = $model;

        if ($img_dir = $this->uploadPic()){
            $item->img_dir = $img_dir;
        }
        if ($id = $this->getID()){
            $item->id = $id ;
        }

        $propertyToUpdate = $this->getPostArray();

        foreach ($propertyToUpdate as $property => $value)
        {
            if ($value == 'password'){
                $item->$property =  password_hash($propertyToUpdate['password'], PASSWORD_DEFAULT);
                continue;
            }
            $item->$property = $value;
        }

        $item->save();

        header("location:?c=" . $modelName );
    }


}