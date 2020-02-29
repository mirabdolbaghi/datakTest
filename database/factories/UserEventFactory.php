<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserEvent;
use Faker\Generator as Faker;

$factory->define(UserEvent::class, function (Faker $faker) {
    return [
        'status' => UserEvent::$requested_status
    ];
});
