<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class GuruUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = 'guru@test.com';
        $password = 'aku12345';

        // ensure role exists if spatie is installed
        if (class_exists(Role::class)) {
            Role::firstOrCreate(['name' => 'guru']);
        }

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Bu Vika',
                'password' => Hash::make($password),
            ]
        );

        if (method_exists($user, 'assignRole')) {
            $user->assignRole('guru');
        }

        $this->command->info("Created user: {$email} with password: {$password}");
    }
}
