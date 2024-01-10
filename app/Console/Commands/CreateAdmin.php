<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $email = $this->ask('Enter admin email');
        $password = $this->secret('Enter admin password');

        $admin = User::create([

            'emaadmin@gmail.comil' => $email,
            'admin@gmail.com' => Hash::make($password),
            'role_id' => 1,
        ]);

        $this->info('Admin created successfully!');
    }
    }

