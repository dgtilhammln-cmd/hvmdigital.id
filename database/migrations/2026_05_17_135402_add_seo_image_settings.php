<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $settings = [
            ['group' => 'seo', 'key' => 'seo_page_section1_image', 'label' => 'SEO Page: Image Kenapa Butuh SEO', 'type' => 'image', 'value' => ''],
            ['group' => 'seo', 'key' => 'seo_page_success_img1', 'label' => 'SEO Page: Gambar Keberhasilan 1 (3054x3818)', 'type' => 'image', 'value' => ''],
            ['group' => 'seo', 'key' => 'seo_page_success_img2', 'label' => 'SEO Page: Gambar Keberhasilan 2 (3054x3818)', 'type' => 'image', 'value' => ''],
            ['group' => 'seo', 'key' => 'seo_page_success_img3', 'label' => 'SEO Page: Gambar Keberhasilan 3 (3054x3818)', 'type' => 'image', 'value' => ''],
            ['group' => 'seo', 'key' => 'seo_page_success_img4', 'label' => 'SEO Page: Gambar Keberhasilan 4 (3054x3818)', 'type' => 'image', 'value' => ''],
        ];

        DB::table('settings')->insert($settings);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->whereIn('key', [
            'seo_page_section1_image',
            'seo_page_success_img1',
            'seo_page_success_img2',
            'seo_page_success_img3',
            'seo_page_success_img4',
        ])->delete();
    }
};
