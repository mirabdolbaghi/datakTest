<?php
/**
 * Created by PhpStorm.
 * User: mohammadmira
 * Date: 2/29/20
 * Time: 9:47 AM
 */

namespace App\Services\UserService;



use Illuminate\Support\ServiceProvider;
use App\Services\UserService\CreateUser\CreateUser;
use App\Services\UserService\CreateUser\CreateUserFactory;



class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerCreateUserService();

    }

    protected function registerCreateUserService()
    {
        $this->app->singleton(CreateUser::class, function () {
            return new CreateUser(
                $this->app->make(CreateUserFactory::class));
        });
    }

}