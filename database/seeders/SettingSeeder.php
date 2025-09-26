<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['type' => 'name', 'value' => 'Ingvanly'],
            ['type' => 'email', 'value' => 'ingvanly168@gmail.com'],
            ['type' => 'phone', 'value' => '+855 96 777 6599'],
            ['type' => 'address', 'value' => 'Siem Reap, Cambodia'],
            ['type' => 'copy_right_text', 'value' => 'Copyright © 2025 Ingvanly.'],
            ['type' => 'logo', 'value' => 'default-logo.png'],
            ['type' => 'favicon', 'value' => 'default.ico'],
        ];

        // Insert default settings into the settings table
        Setting::insert($data);
    }
}
