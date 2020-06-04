<?php

use App\Participant;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Participant::truncate();

        Participant::create(['user_id'=>2, 'tracker_id'=>3, 'permissions'=>7]);
    }
}
