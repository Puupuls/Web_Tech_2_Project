<?php

use App\IncomeSource;
use Illuminate\Database\Seeder;

class IncomeSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncomeSource::truncate();

        IncomeSource::create(['id'=> 1, 'tracker_id'=> 1, 'name'=>'Alga', 'order_idx'=>0]);
        IncomeSource::create(['id'=> 2, 'tracker_id'=> 1, 'name'=>'Stipendija', 'order_idx'=>1]);
        IncomeSource::create(['id'=> 3, 'tracker_id'=> 2, 'name'=>'Mana alga', 'order_idx'=>0]);
        IncomeSource::create(['id'=> 4, 'tracker_id'=> 3, 'name'=>'Finansējums', 'order_idx'=>0]);
        IncomeSource::create(['id'=> 5, 'tracker_id'=> 4, 'name'=>'Test income', 'order_idx'=>0]);
    }
}
