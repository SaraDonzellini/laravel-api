<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'level' => 1,
                'name' => 'Admin',
        ], [
                'level' => 2,
                'name' => 'Moderator',
        ], [
                'level' => 3,
                'name' => 'Editor',
        ], [
                'level' => 4,
                'name' => 'Publisher',
        ], [
                'level' => 5,
                'name' => 'User',
        ],];

        foreach ($roles as $roleName) {
            $NewTechnology = new Role();
            $NewTechnology->level = $roleName['level'];
            $NewTechnology->name = $roleName['name'];
            $NewTechnology->save();
    }
}
}