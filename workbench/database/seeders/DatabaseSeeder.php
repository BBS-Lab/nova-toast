<?php

declare(strict_types=1);

namespace Workbench\Database\Seeders;

use Illuminate\Database\Seeder;
use Workbench\App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed a Nova login user so `composer serve` has an account to sign in with.
     * Log in as nova@laravel.com (password "password").
     */
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'nova@laravel.com'],
            ['name' => 'Laravel Nova', 'password' => 'password'],
        );
    }
}
