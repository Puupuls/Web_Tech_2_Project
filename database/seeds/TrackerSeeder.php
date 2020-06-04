<?php

use App\Tracker;
use Illuminate\Database\Seeder;

class TrackerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tracker::truncate();

        Tracker::create(['id'=>1, 'name'=>'Manas Finanses', 'owner_id'=>1]);
        Tracker::create(['id'=>2, 'name'=>'Ģimenes finanses', 'owner_id'=>1]);
        Tracker::create(['id'=>3, 'name'=>'Projekta finanses', 'owner_id'=>1]);
        Tracker::create(['id'=>4, 'name'=>'Test tracker', 'owner_id'=>2]);
    }
}
