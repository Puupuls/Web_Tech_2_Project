<?php

use App\ExpenseCategory;
use Illuminate\Database\Seeder;

class ExpenseCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseCategory::truncate();

        ExpenseCategory::create(['id'=> 1, 'tracker_id'=> 1, 'name'=>'Ceļojumi', 'order_idx'=>0]);
        ExpenseCategory::create(['id'=> 2, 'tracker_id'=> 1, 'name'=>'Rēķini', 'order_idx'=>1]);
        ExpenseCategory::create(['id'=> 3, 'tracker_id'=> 1, 'name'=>'Pasākumi', 'order_idx'=>2]);
        ExpenseCategory::create(['id'=> 4, 'tracker_id'=> 1, 'name'=>'Pārtika', 'order_idx'=>3]);
        ExpenseCategory::create(['id'=> 5, 'tracker_id'=> 1, 'name'=>'Mašīna', 'order_idx'=>4]);
        ExpenseCategory::create(['id'=> 6, 'tracker_id'=> 2, 'name'=>'Pārtika', 'order_idx'=>0]);
        ExpenseCategory::create(['id'=> 7, 'tracker_id'=> 2, 'name'=>'Remonts', 'order_idx'=>1]);
        ExpenseCategory::create(['id'=> 8, 'tracker_id'=> 3, 'name'=>'Testēšanas izmaksas', 'order_idx'=>0]);
        ExpenseCategory::create(['id'=> 9, 'tracker_id'=> 3, 'name'=>'Hostings', 'order_idx'=>1]);
        ExpenseCategory::create(['id'=> 10, 'tracker_id'=> 3, 'name'=>'Algas', 'order_idx'=>1]);
        ExpenseCategory::create(['id'=> 11, 'tracker_id'=> 4, 'name'=>'Test Expense', 'order_idx'=>0]);
    }
}
