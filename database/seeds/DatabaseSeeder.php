<?php

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
        // $this->call(UserSeeder::class);
        // factory(App\ProjectCategory::class, 1)->create();
        factory(App\Project::class, 7)->create();
    }
}
