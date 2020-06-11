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

        ExpenseCategory::create(['id'=> 1, 'tracker_id'=> 1, 'name'=>'Ceļojumi']);
        ExpenseCategory::create(['id'=> 2, 'tracker_id'=> 1, 'name'=>'Rēķini']);
        ExpenseCategory::create(['id'=> 3, 'tracker_id'=> 1, 'name'=>'Pasākumi']);
        ExpenseCategory::create(['id'=> 4, 'tracker_id'=> 1, 'name'=>'Pārtika']);
        ExpenseCategory::create(['id'=> 5, 'tracker_id'=> 1, 'name'=>'Mašīna']);
        ExpenseCategory::create(['id'=> 6, 'tracker_id'=> 2, 'name'=>'Pārtika']);
        ExpenseCategory::create(['id'=> 7, 'tracker_id'=> 2, 'name'=>'Remonts']);
        ExpenseCategory::create(['id'=> 8, 'tracker_id'=> 3, 'name'=>'Testēšanas izmaksas']);
        ExpenseCategory::create(['id'=> 9, 'tracker_id'=> 3, 'name'=>'Hostings']);
        ExpenseCategory::create(['id'=> 10, 'tracker_id'=> 3, 'name'=>'Algas']);
        ExpenseCategory::create(['id'=> 11, 'tracker_id'=> 4, 'name'=>'Test Expense']);
    }
}
