<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->insert([
    ['key' => 'school_name', 'value' => 'SMK Negeri 10 Surabaya'],
    ['key' => 'school_address', 'value' => 'Jl. Keputih Tegal, Keputih, Sukolilo, Kota SBY, Jawa Timur 60111, Indonesia'],
    ['key' => 'mail_host', 'value' => 'smtp.gmail.com'],
    ['key' => 'mail_port', 'value' => '587'],
    ['key' => 'mail_username', 'value' => 'mmanusia095@gmail.com'],
    ['key' => 'mail_password', 'value' => 'tnod madr byko djan'],
    ['key' => 'mail_encryption', 'value' => 'tls'],
    ['key' => 'mail_from_address', 'value' => 'mmanusia095@gmail.com'],
    ['key' => 'mail_from_name', 'value' => 'EZIN Sekolah'],
    // Konfigurasi WhatsApp Fonnte
]);

    }
}
