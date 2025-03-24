<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Company;
use App\Models\Manager;
use App\Models\Product;
use App\Models\UserSavedProduct;
use App\Models\UserLikeProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('test1234'),
        ]);
        
        User::factory()->count(10)->create();
        Company::factory()->count(10)->create();
        Manager::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        Post::factory()->count(20)->create();
        UserSavedProduct::factory()->count(50)->create();
        UserLikeProduct::factory()->count(50)->create();

    }
}
