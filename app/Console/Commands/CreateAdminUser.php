<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user {--email=admin@khara-consulting.com} {--password=} {--name=Administrateur}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un utilisateur administrateur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password') ?: Str::random(12);
        $name = $this->option('name');

        // Vérifier si l'utilisateur existe déjà
        if (User::where('email', $email)->exists()) {
            $this->error("Un utilisateur avec l'email {$email} existe déjà.");
            return 1;
        }

        // Créer l'utilisateur
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info("✅ Utilisateur administrateur créé avec succès !");
        $this->line("");
        $this->line("Email: {$email}");
        $this->line("Mot de passe: {$password}");
        $this->line("");
        $this->warn("⚠️  Notez bien ce mot de passe, il ne sera plus affiché !");
        $this->line("");
        $this->line("Vous pouvez maintenant vous connecter à: " . route('admin.login'));

        return 0;
    }
}
