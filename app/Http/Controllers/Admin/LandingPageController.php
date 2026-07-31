<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Faq;
use App\Services\ImageService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __construct(private ImageService $img) {}

    public function index()
    {
        $cities       = config('cities');
        $landingPages = LandingPage::all()->keyBy('city_key');
        return view('admin.landing-pages.index', compact('cities', 'landingPages'));
    }

    public function edit(string $cityKey)
    {
        $cityConfig  = config("cities.{$cityKey}");
        if (!$cityConfig) abort(404);

        $landingPage = LandingPage::firstOrNew(
            ['city_key' => $cityKey],
            [
                'city_name'   => $cityConfig['name'],
                'slug'        => $cityConfig['slug'],
                'hero_title'  => $cityConfig['h1'],
                'geo_region'  => $cityConfig['geo_region'],
                'geo_placename' => $cityConfig['name'],
                'geo_position'  => $cityConfig['lat'] . ';' . $cityConfig['lng'],
                'icbm'          => $cityConfig['lat'] . ', ' . $cityConfig['lng'],
                'meta_title'    => $cityConfig['title'],
                'meta_description' => $cityConfig['description'],
            ]
        );

        // Fetch city-specific FAQs
        $faqs = Faq::where('city_key', $cityKey)->orderBy('sort_order')->get();

        return view('admin.landing-pages.edit', compact('cityKey', 'cityConfig', 'landingPage', 'faqs'));
    }

    public function update(Request $request, string $cityKey)
    {
        $cityConfig = config("cities.{$cityKey}");
        if (!$cityConfig) abort(404);

        $data = $request->validate([
            'hero_title'       => 'nullable|string|max:255',
            'hero_subtitle'    => 'nullable|string|max:500',
            'content_intro'    => 'nullable|string',
            'content_why_us'   => 'nullable|string',
            'content_process'  => 'nullable|string',
            'is_active'        => 'boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:320',
            'meta_keywords'    => 'nullable|string',
            'featured_image'   => 'nullable|image|max:5120',
            'og_image'         => 'nullable|image|max:4096',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        $landingPage = LandingPage::where('city_key', $cityKey)->first();

        // 1. Featured Image Upload
        if ($request->hasFile('featured_image')) {
            if ($landingPage?->featured_image) {
                $this->img->delete($landingPage->featured_image);
            }
            $result = $this->img->uploadAndConvert($request->file('featured_image'), 'landing-pages');
            $data['featured_image'] = $result['path'];
        }

        // 2. OpenGraph Image Upload with WebP compression
        if ($request->hasFile('og_image')) {
            if ($landingPage?->og_image) {
                $this->img->delete($landingPage->og_image);
            }
            $result = $this->img->uploadAndConvert($request->file('og_image'), 'landing-pages/og', 1200, 80, 'og-' . $cityKey);
            $data['og_image'] = $result['path'];
        }

        LandingPage::updateOrCreate(
            ['city_key' => $cityKey],
            array_merge($data, [
                'city_name'     => $cityConfig['name'],
                'slug'          => $cityConfig['slug'],
                'geo_region'    => $cityConfig['geo_region'],
                'geo_placename' => $cityConfig['name'],
                'geo_position'  => $cityConfig['lat'] . ';' . $cityConfig['lng'],
                'icbm'          => $cityConfig['lat'] . ', ' . $cityConfig['lng'],
            ])
        );

        // 3. Sync FAQs list (dynamic add/edit/delete)
        $faqData = $request->input('faqs', []);
        $keepIds = [];
        foreach ($faqData as $f) {
            if (!empty($f['question']) && !empty($f['answer'])) {
                $faq = Faq::updateOrCreate(
                    [
                        'id' => $f['id'] ?? null,
                        'city_key' => $cityKey
                    ],
                    [
                        'question'   => $f['question'],
                        'answer'     => $f['answer'],
                        'category'   => 'landing_page',
                        'sort_order' => $f['sort_order'] ?? 0,
                        'is_active'  => isset($f['is_active']) ? (bool)$f['is_active'] : true,
                    ]
                );
                $keepIds[] = $faq->id;
            }
        }
        Faq::where('city_key', $cityKey)->whereNotIn('id', $keepIds)->delete();

        return redirect()->route('admin.landing-pages.index')->with('success', "Landing page {$cityConfig['name']} beserta FAQ berhasil diperbarui!");
    }
}
