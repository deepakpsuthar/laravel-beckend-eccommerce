<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_title', 'value' => 'Mzo'],
            ['key' => 'site_description', 'value' => 'mzo is a ecommerce site.'],
            ['key' => 'admin_email', 'value' => 'admin@example.com'],
            ['key' => 'products_per_page', 'value' => 10],
            ['key' => 'time_zone', 'value' => 'Asia/Kolkata'],
            ['key' => 'time_zone', 'value' => 'Asia/Kolkata'],
            ['key' => 'date_format' ,'value' => 'd/m/Y'],
            ['key' => 'time_format' ,'value' => '12h'],
            ['key' => 'default_language' ,'value' => 'en'],
            ['key' => 'footer_text' ,'value' => 'copyright 2024'],
            ['key' => 'site_logo' ,'value' => 'uploads/defaults/sitelogo.png'],
            ['key' => 'favicon_icon' ,'value' => 'uploads/defaults/favicon.png'],
        ];

        Setting::insert($settings);
    }
}
