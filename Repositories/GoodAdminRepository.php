<?php


namespace App\Repositories;


use App\entities\GoodAdmin;
use App\main\AppCall;

class GoodAdminRepository extends Repository
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
        return GoodAdmin::class;
    }

    /**
     * @inheritDoc
     */
    public function getRepositoryClass()
    {
        return AppCall::call()->goodAdminRepository;
    }
}