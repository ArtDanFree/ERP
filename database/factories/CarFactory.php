<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Car;
use Faker\Generator as Faker;
$factory->define(Car::class, function (Faker $faker) {

    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    $v = $faker->vehicleArray();
    return [
        'name' => $faker->vehicle,
        'type_id' => random_int(1, 3),
    ];
});
