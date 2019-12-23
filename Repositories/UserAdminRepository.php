<?php


namespace App\Repositories;


use App\entities\User;
use App\entities\UserAdmin;
use App\main\AppCall;

class UserAdminRepository extends UserRepository
{
    public function getEntityClass(): string
    {
        return  UserAdmin::class;
    }

    public function getRepositoryClass():object
    {
        return AppCall::call()->userAdminRepository;
    }

}