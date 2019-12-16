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

    public function getOne($id)
    {
        $tableName = $this->getTableName();

        $sql = "SELECT 
                    o.id AS ordersId, oi.id AS orderListId
                FROM 
                    orders AS o
                LEFT JOIN order_list AS oi ON oi.order_id = o.id
                WHERE 
                    o.id = :id
                ";

        return $this->bd->find($sql, [':id' => $id]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->findAll($sql);
    }


}