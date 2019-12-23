<?php


namespace App\Repositories;


use App\entities\Order;
use App\entities\OrderAuth;
use App\main\AppCall;

class OrderAuthRepository extends OrderRepository
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
        return OrderAuth::class;
    }
    public function getRepositoryClass():object
    {
        return AppCall::call()->orderAuthRepository;
    }


    public function getAllOrders($user_id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE user_id = :user_id  ";
        return $this->bd->queryObjs($sql, $this->getEntityClass(), ['user_id' => $user_id]);
    }



}