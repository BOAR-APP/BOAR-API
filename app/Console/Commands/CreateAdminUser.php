<?php
// app/Console/Commands/CreateAdminUser.php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'user:create-admin {email} {password} {--name=Admin}';
    protected $description = 'Create an admin user';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->option('name');

        if (User::where('email', $email)->exists()) {
            $this->error("User with email {$email} already exists!");
            return 1;
        }

        $user = User::create([
            'firstname' => $name,
            'lastname' => '',
            'username' => strstr($email, '@', true),
            'email' => $email,
            'password' => Hash::make($password),
            'verified' => true,
            'last_activity' => now(),
            'status' => 2,
        ]);

        $this->info("Admin user created successfully!");
        $this->table(
            ['ID', 'Email', 'Admin'],
            [[$user->id, $user->email, $user->status == 2 ? 'Yes' : 'No']]
        );

        return 0;
    }
}
