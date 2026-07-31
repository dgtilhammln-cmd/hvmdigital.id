<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        $slides = HeroSlide::orderBy('order')->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'headline' => 'required|string|max:255',
            'subheadline' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'image' => 'required|image|max:5120', // 5MB max
            'order' => 'integer',
            'is_active' => 'boolean',
            'rating_text' => 'nullable|string|max:100',
            'stars' => 'nullable|integer|min:1|max:5',
            'feature_1' => 'nullable|string|max:100',
            'feature_2' => 'nullable|string|max:100',
            'feature_3' => 'nullable|string|max:100',
            'avatar_1' => 'nullable|image|max:2048',
            'avatar_2' => 'nullable|image|max:2048',
            'avatar_3' => 'nullable|image|max:2048',
            'custom_filename' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $customName = $request->input('custom_filename') ?: 'slide-' . $request->headline;
            $upload = $this->imageService->uploadAndConvert($request->file('image'), 'hero_slides', 1920, 80, $customName);
            $validated['image'] = $upload['path'];
        }

        $i = 1;
        foreach (['avatar_1', 'avatar_2', 'avatar_3'] as $avatarField) {
            if ($request->hasFile($avatarField)) {
                $customName = ($request->input('custom_filename') ?: 'avatar-' . $request->headline) . '-' . $i;
                $upload = $this->imageService->uploadAndConvert($request->file($avatarField), 'hero_slides_avatars', 400, 80, $customName);
                $validated[$avatarField] = $upload['path'];
            }
            $i++;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['stars'] = $request->input('stars', 5);

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit(HeroSlide $hero_slide)
    {
        return view('admin.hero-slides.edit', compact('hero_slide'));
    }

    public function update(Request $request, HeroSlide $hero_slide)
    {
        $validated = $request->validate([
            'headline' => 'required|string|max:255',
            'subheadline' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'order' => 'integer',
            'rating_text' => 'nullable|string|max:100',
            'stars' => 'nullable|integer|min:1|max:5',
            'feature_1' => 'nullable|string|max:100',
            'feature_2' => 'nullable|string|max:100',
            'feature_3' => 'nullable|string|max:100',
            'avatar_1' => 'nullable|image|max:2048',
            'avatar_2' => 'nullable|image|max:2048',
            'avatar_3' => 'nullable|image|max:2048',
            'custom_filename' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($hero_slide->image) {
                Storage::disk('public')->delete($hero_slide->image);
            }
            $customName = $request->input('custom_filename') ?: 'slide-' . $request->headline;
            $upload = $this->imageService->uploadAndConvert($request->file('image'), 'hero_slides', 1920, 80, $customName);
            $validated['image'] = $upload['path'];
        }

        $i = 1;
        foreach (['avatar_1', 'avatar_2', 'avatar_3'] as $avatarField) {
            if ($request->hasFile($avatarField)) {
                if ($hero_slide->$avatarField) {
                    Storage::disk('public')->delete($hero_slide->$avatarField);
                }
                $customName = ($request->input('custom_filename') ?: 'avatar-' . $request->headline) . '-' . $i;
                $upload = $this->imageService->uploadAndConvert($request->file($avatarField), 'hero_slides_avatars', 400, 80, $customName);
                $validated[$avatarField] = $upload['path'];
            }
            $i++;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['stars'] = $request->input('stars', 5);

        $hero_slide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(HeroSlide $hero_slide)
    {
        if ($hero_slide->image) {
            Storage::disk('public')->delete($hero_slide->image);
        }
        $hero_slide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide berhasil dihapus.');
    }
}
