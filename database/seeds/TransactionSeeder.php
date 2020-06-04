<?php

use App\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::truncate();

        Transaction::create([
            'id'=>1,
            'expense_category_id'=>2,
            'tracker_id'=>1,
            'added_by_user_id' => 1,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Phone',
            'amount' => 15.0,
            'image_uuid' => null]);
        Transaction::create([
            'id'=>2,
            'expense_category_id'=>null,
            'tracker_id'=>3,
            'added_by_user_id' => 2,
            'income_source_id' => 4,
            'is_income' => true,
            'description'=>'Finansējums',
            'amount' => 123.45,
            'image_uuid' => null]);
        Transaction::create([
            'id'=>3,
            'expense_category_id'=>8,
            'tracker_id'=>3,
            'added_by_user_id' => 2,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Hostings',
            'amount' => 50,
            'image_uuid' => null]);
        Transaction::create([
            'id'=>4,
            'expense_category_id'=>9,
            'tracker_id'=>3,
            'added_by_user_id' => 2,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Testēšana',
            'amount' => 60,
            'image_uuid' => null]);
        Transaction::create([
            'id'=>5,
            'expense_category_id'=>10,
            'tracker_id'=>3,
            'added_by_user_id' => 1,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Algu izmaksas',
            'amount' => 500,
            'image_uuid' => null]);
    }
}
