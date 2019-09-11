<?php

use App\Models\Car;
use App\Models\Driver;
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
        $this->call(CarStatusesTableSeeder::class);
        $this->call(CarTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        factory(Driver::class, 5)->create();
        factory(Car::class, 10)->create();
    }
}
