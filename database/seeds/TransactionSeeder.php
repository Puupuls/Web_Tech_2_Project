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
            'expense_category_id'=>2,
            'tracker_id'=>1,
            'added_by_user_id' => 1,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Phone',
            'amount' => 15.0,
            'image_uuid' => null,
            'created_at' => \Carbon\Carbon::create(2020, 6, 11, 12, 25, 0)
        ]);
        Transaction::create([
            'expense_category_id'=>null,
            'tracker_id'=>3,
            'added_by_user_id' => 1,
            'income_source_id' => 4,
            'is_income' => true,
            'description'=>'Finansējums',
            'amount' => 123.45,
            'image_uuid' => null,
            'created_at' => \Carbon\Carbon::create(2020, 5, 21, 20, 14, 12)
        ]);
        Transaction::create([
            'expense_category_id'=>9,
            'tracker_id'=>3,
            'added_by_user_id' => 1,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Hostings',
            'amount' => 49.99,
            'image_uuid' => null,
            'created_at' => \Carbon\Carbon::create(2020, 6, 5, 14, 2, 59)
        ]);
        Transaction::create([
            'expense_category_id'=>8,
            'tracker_id'=>3,
            'added_by_user_id' => 2,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Testēšana',
            'amount' => 60.49,
            'image_uuid' => null,
            'created_at' => \Carbon\Carbon::create(2020, 6, 7, 8, 57, 52)
        ]);
        Transaction::create([
            'expense_category_id'=>8,
            'tracker_id'=>3,
            'added_by_user_id' => 2,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Testēšana',
            'amount' => 17.01,
            'image_uuid' => null,
            'created_at' => \Carbon\Carbon::create(2020, 6, 7, 12, 43, 35)
        ]);
        Transaction::create([
            'expense_category_id'=>8,
            'tracker_id'=>3,
            'added_by_user_id' => 2,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Testēšana',
            'amount' => 29.99,
            'image_uuid' => null,
            'created_at' => \Carbon\Carbon::create(2020, 6, 9, 9, 11, 13)
        ]);
        Transaction::create([
            'expense_category_id'=>null,
            'tracker_id'=>3,
            'added_by_user_id' => 1,
            'income_source_id' => 4,
            'is_income' => true,
            'description'=>'Finansējums',
            'amount' => 750,
            'image_uuid' => null,
            'created_at' => \Carbon\Carbon::create(2020, 6, 10, 10, 1, 7)
        ]);
        Transaction::create([
            'expense_category_id'=>10,
            'tracker_id'=>3,
            'added_by_user_id' => 1,
            'income_source_id' => null,
            'is_income' => false,
            'description'=>'Algu izmaksas',
            'amount' => 500,
            'image_uuid' => null,
            'created_at' => \Carbon\Carbon::create(2020, 6, 10, 16, 26, 24)
        ]);
    }
}
