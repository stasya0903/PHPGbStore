<?php


namespace App\Repositories;


use App\entities\Order;

class OrderRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
        return 'orders';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return Order::class;
    }
    public function getOne($id)
    {
        $tableName = $this->getTableName();

        $sql = "SELECT *
                FROM orders 
                LEFT JOIN order_list ON order_list.order_id = orders.id
                lEFT JOIN goods ON order_list.goods_id = goods.id
                WHERE 
                    orders.id = :id";



        return $this->bd->find($sql, [':id' => $id]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->bd->findAll($sql);
    }
}