<?php


namespace App\Repositories;


use App\entities\Good;
use App\main\AppCall;

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

    public function getRepositoryClass(): object
    {
        return AppCall::call()->goodRepository;
    }
}