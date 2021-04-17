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
        $this->call(UsersSeeder::class);
        $this->call(StationsSeeder::class);
        $this->call(BusesSeeder::class);
        $this->call(SeatsSeeder::class);
        $this->call(TripsSeeder::class);
        $this->call(RoutesSeeder::class);
    }
}
