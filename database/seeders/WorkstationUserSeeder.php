<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class WorkstationUserSeeder extends Seeder
{
   public function run ()
{
    $email = "work@gmail.com";
    $password = "aku12345";

    if(class_exists(Role::class)) {
        Role::firstOrCreate(['name' => 'workstation']);
    }
    $user = User::firstOrCreate(
        ['email' => $email],
        [
            'name' => 'Work Station',
            'password' => Hash::make($password),
        ]
    );

    if(method_exists($user, 'assignRole')){
        $user->assignRole('workstation');
    }

    $this->command->info("created {$email} with pw {$password}");

}
}