<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Armaments;
use App\CraftTypes;
use App\SpaceCraft;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(CraftTypes::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(SpaceCraft::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status' => $faker->name,
        'crafttypes_id' => rand(1,3),
        'crew' => rand(1,1000000),
        'value' => rand(1,1000000),
        'image'	=> $faker->url,
    ];
});

$factory->define(Armaments::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        //'qty' => (string)rand(1,10000000000),
        //'space_craft_id' => rand(1,10)
    ];
});
