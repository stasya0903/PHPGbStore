<?php


namespace App\Repositories;


use App\entities\Good;
use App\entities\GoodAuth;
use App\main\AppCall;

class GoodAuthRepository extends Repository
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
        return GoodAuth::class;
    }

    public function getRepositoryClass(): object
    {
        return AppCall::call()->goodAuthRepository;
    }
}