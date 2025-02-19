<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Nom de l\'administrateur');
        $email = $this->ask('Email de l\'administrateur');
        $password = $this->secret('Mot de passe');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'role' => 'admin',
        ]);

        $this->info('Administrateur créé avec succès !');
    }
}
