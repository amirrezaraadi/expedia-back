<?php

namespace Database\Seeders;

use App\Models\Panel\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $user = \App\Models\User::find(1);

        for ($i = 1; $i <= 100; $i++) {
            Category::query()->create([
                'title'  => $faker->title,
                'slug' =>  $faker->unique()->slug,
                'parent_id' =>  null,
                'user_id' => $user->id ,
            ]);
        }
    }
}
