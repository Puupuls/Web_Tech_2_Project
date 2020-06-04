<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->call(UserSeeder::class);
        $this->call(TrackerSeeder::class);
        $this->call(ParticipantSeeder::class);
        $this->call(IncomeSourceSeeder::class);
        $this->call(ExpenseCategoriesSeeder::class);
        $this->call(TransactionSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
