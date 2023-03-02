<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        
        for ($i = 0; $i < 800; $i++) {
            $newProject = new Project();
            $newProject->type_id = Type::inRandomOrder()->first()->id;
            $newProject->title = $faker->unique()->realText(20);
            $newProject->slug = Str::slug($newProject->title);
            $newProject->author = $faker->name();
            $newProject->image = $faker->imageUrl(640, 480, 'animals', true);
            $newProject->content = $faker->realTextBetween(1600, 3000);
            $newProject->date = $faker->dateTimeThisYear();
            $newProject->save();
        }
    }
}