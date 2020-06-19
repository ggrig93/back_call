<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:manager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new role and user * Manager * ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        //create manager role if not exists
        $adminRole = config('roles.models.role')::updateOrCreate(
            [
                'name' => 'Manager',
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Manager',
                'level' => 2,
            ]);

        // create new user Manager if not exists
        $user = config('roles.models.defaultUser')::updateOrCreate(
            [
                'email' => 'manager@gmail.com',
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456'),
            ]);

        $user->attachRole($adminRole);

    }
}
