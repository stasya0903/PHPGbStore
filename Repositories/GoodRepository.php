<?php


namespace App\Repositories;


use App\entities\Good;

class GoodRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
        return "goods";
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return Good::class;
    }
}