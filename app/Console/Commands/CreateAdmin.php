<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    protected $signature = 'khara:create-admin
                            {name? : Nom de l\'administrateur}
                            {email? : Adresse email}
                            {password? : Mot de passe (min. 8 caractères)}';

    protected $description = 'Crée un compte administrateur (super-administrateur) Khara Consulting';

    public function handle(): int
    {
        $name = $this->argument('name') ?: $this->ask('Nom');
        $email = $this->argument('email') ?: $this->ask('Email');
        $password = $this->argument('password') ?: $this->secret('Mot de passe (min. 8 caractères)');

        $validator = Validator::make(
            compact('name', 'email', 'password'),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        $this->info("Administrateur créé : {$email} (super-administrateur).");

        return self::SUCCESS;
    }
}
