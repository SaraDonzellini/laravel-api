<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['HTML5', 'CSS3', 'SCSS', 'JS ES6', 'PHP', 'Vue 3', 'Laravel 9', 'Bootstrap 5', 'Vite'];

        foreach ($technologies as $technologyName) {
            $technology = new Technology();
            $technology->name = $technologyName;
            $technology->save();
    }
}
}