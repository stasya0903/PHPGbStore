<?php


namespace App\Repositories;


class UserRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
        return 'users';
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return  User::class;
    }
}