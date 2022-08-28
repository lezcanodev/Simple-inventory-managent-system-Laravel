<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\{User, Provider, Product};
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory(1, [
            'id' => 1,
            'rol_id' => 1,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456')
        ])
        ->has(Provider::factory()->count(10)->hasAttached(Category::factory()->count(fake()->numberBetween(1, 5))))
        ->create();

        User::create([
            'id' => 2,
            'rol_id' => 2,
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('123456')
        ]);

        
        $providers = Provider::get();

        foreach($providers as $provider){
            $providerId = $provider->id;
            $categories = $provider->categories->toArray();
            shuffle($categories);
            $categoryId   = $provider->categories[0]->id;
            
            $items = [];

            Product::factory(fake()->numberBetween(1, 5), [
                'provider_id' => $providerId,
                'category_id' => $categoryId
            ])->create()/*->create()->each(function($product) use ($categoryId,  &$items ){
                array_push($items,[
                    'category_id' => $categoryId,
                    'categorizables_id' => $product->id,
                    'categorizables_type' => 'App\Models\Product'
                ]);
            })*/;

           // DB::table('categorizables')->insert($items);
        
        }

    }
}
