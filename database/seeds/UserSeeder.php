<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create(array('id'=>1, 'name' => 'Pauls',
            'email' => 'pauls@projekts.test',
            'password' => bcrypt('secret'),
            'is_admin' => true));
        User::create(array('id'=>2, 'name' => 'Test',
            'email' => 'test@projekts.test',
            'password' => bcrypt('secret'),
            'is_admin' => false));
    }
}
