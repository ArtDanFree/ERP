<?php

use App\Models\CarStatuses;
use Illuminate\Database\Seeder;

class CarStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarStatuses::create([
            'name' => 'Активная'
        ]);
        CarStatuses::create([
            'name' => 'На ремонте'
        ]);
        CarStatuses::create([
            'name' => 'Продана'
        ]);
        CarStatuses::create([
            'name' => 'Не используется',
        ]);

    }
}
