<?php

namespace Database\Seeders;

use App\Models\User\Hotel;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $user = \App\Models\User::find(1);

        for ($i = 1; $i <= 1000; $i++) {
            Hotel::query()->create([
                'name'  => $faker->title,
                'slug' =>  $faker->unique()->slug,
                'number' => random_int(111111111 , 999999999),
                'map' => $faker->md5('asdasddasd'),
                'content' => $faker->text(),
                'city_id' => random_int(111 , 999),
            ]);
        }
    }
}
