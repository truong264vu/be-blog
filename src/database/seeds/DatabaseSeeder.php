<?php

use Illuminate\Database\Seeder;
// use App\Database\Seeds\PostTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(PostCategoryTableSeeder::class);
        $this->call(UserTableSeed::class);

    }
}
