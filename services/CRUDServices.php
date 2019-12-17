<?php


namespace App\services;
use App\modules\Model;
use App\services\renders\IRender;

class CRUDServices
{

    /**
     * @param Model $model
     * @param IRender $render
     * @param string $nameSng
     * @return mixed
     */
    public function all($model, $render, $nameSng)
    {
        $items = $model->getAll();
        return $render->render("$nameSng", ["$nameSng" => $items]);
    }

    /**
     * @param Model $model
     * @param IRender $render
     * @param Request $request
     * @param string $nameSng
     * @return mixed
     */

    public function one($model,$render,$request, $nameSng)
    {
        if (!$id = $request->get("id"))
        {
           header("location:./");
        }

        $item = $model->getOne($id);
        return $render->render("$nameSng", ["$nameSng" => $item]);
    }

    /**
     * @param Request $request
     * @param IRender $render
     * @param Model $model
     * @param string $nameSng
     */
    public function addToDB ($request,$render, $model, $nameSng)
    {
        if(!$request->isPost()) {

            if ($id = $request->get("id")) {
                $item = $model->getOne($id);
                return  $render->render($nameSng."Update", ["user"=>$item]);
            }

           return   $render->render($nameSng."Add");
        }

        $item = $model;

        if ($img_dir = $request->uploadPic()){
            $item->img_dir = $img_dir;
        }
        if ($id = $request->get("id")){
            $item->id = $id ;
        }

        $propertyToUpdate = $request->post();

        foreach ($propertyToUpdate as $property => $value)
        {
            if ($value == 'password'){
                $item->$property =  password_hash($propertyToUpdate['password'], PASSWORD_DEFAULT);
                continue;
            }
            $item->$property = $value;
        }
        $item->save();
        return header('Location:/' . $nameSng);

    }

    /**
     * @param Model $model
     * @param Request $request
     * @param string $nameSng
     */

    public function delete ($model,$request,$nameSng)
    {
        if (!$id = $request->get("id"))
        {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $item = $model;
        $item->id = $id;
        $item->delete();

        header("location:/" . $nameSng );

    }
}
