<?php

namespace App\Services\UserService\CreateUser;


use App\Services\UserService\CreateUser\ValueObjects\CreateUserValueObject;
use App\User;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    /**
     * @var CreateUserFactory
     */
    protected $factory;

    public function __construct(
        CreateUserFactory $factory
    )
    {
        $this->factory = $factory;
    }

    public function create(CreateUserValueObject $valueObject): User
    {
        $user = $this->factory->getUser();

        $user = $user::create([
            'name'     => $valueObject->getName(),
            'image'     => $valueObject->getImage(),
            'mobile'     => $valueObject->getMobile(),
            'email'    => $valueObject->getEmail(),
            'password' => Hash::make($valueObject->getPassword()),
        ]);



        return $user;
    }
}
