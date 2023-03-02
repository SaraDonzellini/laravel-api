<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $types = ['front-end', 'back-end', 'full-stack'];

        foreach ($types as $typeName) {
            $type = new Type();
            $type->type = $typeName;
            $type->save();
        }
    }
}