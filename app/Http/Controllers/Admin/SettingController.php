<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        if (!Setting::where('group', 'feeds')->exists()) {
            (new \Database\Seeders\SettingsSeeder())->run();
        }
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Get all submitted fields except Laravel system fields
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            // Skip file fields here — handled below
            if ($request->hasFile($key)) {
                continue;
            }
            // Only save if setting exists in DB (prevents arbitrary key injection)
            if (Setting::where('key', $key)->exists()) {
                Setting::set($key, $value);
            }
        }

        // Now handle file uploads separately
        foreach ($request->allFiles() as $key => $file) {
            // Validate it's an image
            if (!in_array($file->getMimeType(), [
                'image/jpeg','image/png','image/gif','image/webp','image/svg+xml'
            ])) {
                continue;
            }
            if ($key === 'og_image_default') {
                $result = $this->imageService->uploadOriginal($file, 'settings');
            } else {
                $result = $this->imageService->uploadAndConvert($file, 'settings');
            }
            Setting::set($key, $result['path']);
        }

        // Clear settings helper cache (static cache in helpers.php won't clear, but
        // next request will be fresh)
        cache()->forget('settings_all');

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
