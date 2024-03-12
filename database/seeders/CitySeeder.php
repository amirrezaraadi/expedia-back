<?php

namespace Database\Seeders;

use App\Models\User\City;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $user = \App\Models\User::find(1);

        for ($i = 1; $i <= 1000; $i++) {
            City::query()->create([
                'name'  => $faker->title,
                'slug' =>  $faker->unique()->slug,
                'number' => random_int(111111111 , 999999999),
                'map' => $faker->md5('asdasddasd'),
                'content' => $faker->text(),
                'country_td' => random_int(111 , 999),
            ]);
        }
    }
}
