<?php

namespace App\Services\UserService\CreateUser;


use App\User;

class CreateUserFactory
{
    public function getUser(): User
    {
        return new User();
    }
}
