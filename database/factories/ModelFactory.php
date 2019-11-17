<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Autor::class, function (Faker\Generator $faker) {
   
    return [
        'nombre_autor' => $faker->name,
        'estado'=>$faker->numberBetween($min = 1, $max = 1)
    ];
});


$factory->define(App\Idiom::class, function (Faker\Generator $faker) {
   
    return [
        'nombre_idioma' => $faker->name,
        'estado'=>$faker->numberBetween($min = 1, $max = 1)
    ];
});


$factory->define(App\Editorial::class, function (Faker\Generator $faker) {
   
    return [
        'nombre_editorial' => $faker->name,
        'estado'=>$faker->numberBetween($min = 1, $max = 1)
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
   
    return [
        'nombre_categoria' => $faker->name,
        'estado'=>$faker->numberBetween($min = 1, $max = 1)
    ];
});