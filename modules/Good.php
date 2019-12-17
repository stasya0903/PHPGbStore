<?php


namespace App\modules;


class Good extends Model
{

    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    public function getTableName(): string
    {
        return 'goods';
    }
    public function getClassName(): string
    {
        return 'Good';
    }


    public function getData()
    {
        $data = [];
        foreach ($this as $property => $value){
            if ($property == 'bd'){
                continue;
            }
           $data[$property] = $value;

        }
        return $data;
    }



}