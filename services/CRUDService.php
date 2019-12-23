<?php

namespace App\services;

use App\entities\Entity;
use App\Repositories\Repository;


class CRUDService
{
    /**
     * @param $params
     * @param Repository $repository
     * @param Request$request
     * @param Entity $entity
     * @return array
     */
    public function fillUser($params, $repository, $request, $entity = null)
    {
        /*if ($this->hasErrors($params)) {
            return [
                'msg' => 'Нет данных',
                'success' => false,
            ];
        }
        TO DO add the to check all the modules*/



        if (empty($entity)) {
            $className = $repository->getEntityClass();
            $entity = new $className;
        }

        if ($img_dir = $request->uploadPic()){
            $entity->img_dir = $img_dir;
        }

        foreach ($params as $property => $value)
        {
            if ($property == 'password'){
                if(!empty($value)){
                    $entity->$property =  password_hash($value, PASSWORD_DEFAULT);
                }
                continue;
            }
            $entity->$property = $value;
        }

        ($repository)->save($entity);

        return [
            'success' => true,
        ];
    }

    /**
     * @param int $id
     * @param Repository $repository
     */

    public function delete ($id, $repository)
    {
        $className = $repository->getEntityClass();
        $entity = new $className;
        $entity->id = $id;
        $repository->delete($entity);
    }


    protected function hasErrors($params)
    {
        if (empty($params['login']) || empty($params['password'])) {
            return true;
        }

        return false;
    }


}