<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            SettingsSeeder::class,
            ContentSeeder::class,
            ArticleCategorySeeder::class,
            ArticleSeeder::class,
            InternshipSeeder::class,
            PricingPackagesSeeder::class,
        ]);
    }
}
