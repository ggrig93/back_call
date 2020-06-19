<?php

use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $statuses = [
            [
                'status' => 'Opened',
            ],
            [
                'status' => 'Seen',
            ],
            [
                'status' => 'Not Seen',
            ],
            [
                'status' => 'Closed',
            ],
        ];

        \App\Models\Status::insert($statuses);

    }
}
