<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Permission;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Action::insert([
            ['id' => 1, 'action' => 'create'],
            ['id' => 2, 'action' => 'update'],
            ['id' => 3, 'action' => 'delete'],
            ['id' => 4, 'action' => 'read'],
            ['id' => 5, 'action' => 'my_update'],
            ['id' => 6, 'action' => 'my_delete']
        ]);
 
        Section::insert([
            ['id' => 1 , 'model' => 'App\Models\Product'],
            ['id' => 2 , 'model' => 'App\Models\Provider'],
            ['id' => 3 , 'model' => 'App\Models\Rol'],
            ['id' => 4 , 'model' => 'App\Models\Category'],
            ['id' => 5 , 'model' => 'App\Models\User']
        ]);

        Permission::insert([
            [
                'rol_id' => 2,
                'action_id' => 1,
                'section_id' =>  1
            ],
            [
                'rol_id' => 2,
                'action_id' => 4,
                'section_id' =>  1
            ],
            [
                'rol_id' => 2,
                'action_id' => 5,
                'section_id' =>  1
            ],
            [
                'rol_id' => 2,
                'action_id' => 6,
                'section_id' =>  1
            ]
        ]);

    }
}
