<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private ImageService $img) {}

    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'icon'              => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:300',
            'description'       => 'nullable|string',
            'price_start'       => 'nullable|numeric',
            'is_active'         => 'boolean',
            'sort_order'        => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:320',
            'meta_keywords'     => 'nullable|string',
            'featured_image'    => 'nullable|image|max:5120',
            'custom_filename'   => 'nullable|string|max:255',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('featured_image')) {
            $customName = $request->input('custom_filename') ?: 'jasa-' . $request->name;
            $result = $this->img->uploadAndConvert($request->file('featured_image'), 'services', 1920, 80, $customName);
            $data['featured_image'] = $result['path'];
        }

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil disimpan!');
    }

    public function edit(Service $service)
    {
        $faqs = \App\Models\Faq::where('category', $service->slug)->orderBy('sort_order')->get();
        return view('admin.services.edit', compact('service', 'faqs'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'icon'              => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:300',
            'description'       => 'nullable|string',
            'price_start'       => 'nullable|numeric',
            'is_active'         => 'boolean',
            'sort_order'        => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:320',
            'meta_keywords'     => 'nullable|string',
            'featured_image'    => 'nullable|image|max:5120',
            'og_image'          => 'nullable|image|max:4096',
            'custom_filename'   => 'nullable|string|max:255',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('featured_image')) {
            if ($service->featured_image) $this->img->delete($service->featured_image);
            $customName = $request->input('custom_filename') ?: 'jasa-' . $request->name;
            $result = $this->img->uploadAndConvert($request->file('featured_image'), 'services', 1920, 80, $customName);
            $data['featured_image'] = $result['path'];
        }

        if ($request->hasFile('og_image')) {
            if ($service->og_image) $this->img->delete($service->og_image);
            $result = $this->img->uploadAndConvert($request->file('og_image'), 'services/og', 1200, 80, 'og-service-' . $service->slug);
            $data['og_image'] = $result['path'];
        }

        $service->update($data);

        // Sync FAQs
        $faqData = $request->input('faqs', []);
        $keepIds = [];
        foreach ($faqData as $f) {
            if (!empty($f['question']) && !empty($f['answer'])) {
                $faq = \App\Models\Faq::updateOrCreate(
                    [
                        'id' => $f['id'] ?? null,
                        'category' => $service->slug
                    ],
                    [
                        'question'   => $f['question'],
                        'answer'     => $f['answer'],
                        'city_key'   => null,
                        'sort_order' => $f['sort_order'] ?? 0,
                        'is_active'  => isset($f['is_active']) ? (bool)$f['is_active'] : true,
                    ]
                );
                $keepIds[] = $faq->id;
            }
        }
        \App\Models\Faq::where('category', $service->slug)->whereNotIn('id', $keepIds)->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan beserta FAQ berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        if ($service->featured_image) $this->img->delete($service->featured_image);
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
