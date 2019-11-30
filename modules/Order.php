<?php


namespace App\modules;


class Order extends Model
{
    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    public function getTableName(): string
    {
        return 'orders';
    }

}