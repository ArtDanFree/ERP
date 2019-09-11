<?php

use App\Models\CarType;
use Illuminate\Database\Seeder;

class CarTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarType::create([
            'name' => 'Легковой автомобиль'
        ]);
        CarType::create([
            'name' => 'Грузовик'
        ]);
        CarType::create([
            'name' => 'Фургон'
        ]);
    }
}
