<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
       //// \App\Models\Category::factory(10)->create();
      /// \App\Models\Product::factory(10)->create();
      //// \App\Models\Client::factory(10)->create();
       ////\App\Models\Contac::factory(20)->create();
      //// \App\Models\Sale::factory(10)->create();

      
      //// \App\Models\Sale::factory(4)-> create();
       ////\App\Models\Detail::factory(2)-> create();
      \App\Models\Sale::factory(4)
      ->has(\App\Models\Detail::factory(2)->count(2))
      ->create();
    }
}
