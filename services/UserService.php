<?php

namespace App\services;

use App\entities\Entity;
use App\Repositories\Repository;


class UserService
{
    /**
     * @param $params
     * @param Entity $entity
     * @param $entityName
     * @param Repository $Repository
     * @return array
     */
    public function fillUser($params, $entity , $entityName, $Repository)
    {
        /*if ($this->hasErrors($params)) {
            return [
                'msg' => 'Нет данных',
                'success' => false,
            ];
        }
        TO DO add the to check all the modules*/



        if (empty($entity)) {
            $entity = new $entityName();
        }

        foreach ($params as $property => $value)
        {
            if ($value == 'password'){
                $entity->$property =  password_hash($params['password'], PASSWORD_DEFAULT);
                continue;
            }
            $entity->$property = $value;
        }

        ($Repository)->save($entity);

        return [
            'success' => true,
        ];
    }

    protected function hasErrors($params)
    {
        if (empty($params['login']) || empty($params['password'])) {
            return true;
        }

        return false;
    }
}