<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    protected $signature = 'app:create-user';

    protected $description = 'Create user command';

    public function handle()
    {
        $email = $this->ask('Email');
        $name = $this->ask('Name');
        $role = $this->choice('role', [User::ROLE_SU, User::ROLE_VERIFIKASI, User::ROLE_TELAAH], User::ROLE_SU);
        $password = $this->ask('Password');
        $validator = \Validator::make([
            'email' => $email,
            'name' => $name,
            'role' => $role
        ], [
            'email' => 'required|email',
            'name' => 'required',
            'role' => 'required'
        ]);
        if ($validator->fails()) {
            $this->info('Kesalahan membuat user:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }
        $password = $password ?? \Str::random(8);

        if ($user = User::create([
            'email' => $email,
            'name' => $name,
            'role' => $role,
            'password' => \Hash::make($password)

        ])) {
            $this->info("User telah dibuat.");
            $this->info("Email: " . $email);
            $this->info("Password: " . $password);
            $user->markEmailAsVerified();
        }
    }
}
