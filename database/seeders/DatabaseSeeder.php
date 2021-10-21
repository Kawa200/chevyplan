<?php

namespace Database\Seeders;

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
        \App\Models\Client::factory(50)->create();
        \App\Models\Plan::factory(30)->create();
        \App\Models\Payment::factory(100)->create();
    }
}
