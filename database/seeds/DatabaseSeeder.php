<?php

use App\Models\Car;
use App\Models\User;
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
        $this->call(LaratrustSeeder::class);
        factory(User::class, 5)->create()
            ->each(function (\App\Models\User $user) {
                $user->roles()->sync(['id'=> 2]);
            });;
        factory(Car::class, 10)->create();
    }
}
