<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function __construct(private ImageService $img) {}

    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->paginate(20);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $cities = config('cities');
        return view('admin.testimonials.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'company'      => 'nullable|string|max:255',
            'city'         => 'nullable|string|max:100',
            'city_key'     => 'nullable|string|max:50',
            'content'      => 'required|string',
            'rating'       => 'required|integer|min:1|max:5',
            'service_used' => 'nullable|string|max:255',
            'is_active'    => 'boolean',
            'sort_order'   => 'nullable|integer',
            'photo'        => 'nullable|image|max:2048',
            'custom_filename'=> 'nullable|string|max:255',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('photo')) {
            $customName = $request->input('custom_filename') ?: 'testimoni-' . $request->name . '-' . $request->company;
            $result = $this->img->uploadAndConvert($request->file('photo'), 'testimonials', 800, 80, $customName);
            $data['photo']       = $result['path'];
            $data['photo_thumb'] = $result['thumb_path'];
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil disimpan!');
    }

    public function edit(Testimonial $testimonial)
    {
        $cities = config('cities');
        return view('admin.testimonials.edit', compact('testimonial', 'cities'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'company'      => 'nullable|string|max:255',
            'city'         => 'nullable|string|max:100',
            'city_key'     => 'nullable|string|max:50',
            'content'      => 'required|string',
            'rating'       => 'required|integer|min:1|max:5',
            'service_used' => 'nullable|string|max:255',
            'is_active'    => 'boolean',
            'sort_order'   => 'nullable|integer',
            'photo'        => 'nullable|image|max:2048',
            'custom_filename'=> 'nullable|string|max:255',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) $this->img->delete($testimonial->photo);
            $customName = $request->input('custom_filename') ?: 'testimoni-' . $request->name . '-' . $request->company;
            $result = $this->img->uploadAndConvert($request->file('photo'), 'testimonials', 800, 80, $customName);
            $data['photo']       = $result['path'];
            $data['photo_thumb'] = $result['thumb_path'];
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) $this->img->delete($testimonial->photo);
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus!');
    }
}
