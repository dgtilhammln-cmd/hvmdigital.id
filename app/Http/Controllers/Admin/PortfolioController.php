<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Services\ImageService;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct(private ImageService $img) {}

    public function index()
    {
        $portfolios = Portfolio::orderBy('sort_order')->paginate(20);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'client'         => 'nullable|string|max:255',
            'category'       => 'nullable|string|max:100',
            'description'    => 'nullable|string',
            'url'            => 'nullable|url|max:255',
            'city'           => 'nullable|string|max:100',
            'is_active'      => 'boolean',
            'sort_order'     => 'nullable|integer',
            'featured_image' => 'nullable|image|max:5120',
            'custom_filename'=> 'nullable|string|max:255',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('featured_image')) {
            $customName = $request->input('custom_filename') ?: 'portofolio-' . $request->title;
            $result = $this->img->uploadAndConvert($request->file('featured_image'), 'portfolios', 1920, 80, $customName);
            $data['featured_image']       = $result['path'];
            $data['featured_image_thumb'] = $result['thumb_path'];
        }

        Portfolio::create($data);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil disimpan!');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'client'         => 'nullable|string|max:255',
            'category'       => 'nullable|string|max:100',
            'description'    => 'nullable|string',
            'url'            => 'nullable|url|max:255',
            'city'           => 'nullable|string|max:100',
            'is_active'      => 'boolean',
            'sort_order'     => 'nullable|integer',
            'featured_image' => 'nullable|image|max:5120',
            'custom_filename'=> 'nullable|string|max:255',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('featured_image')) {
            if ($portfolio->featured_image) $this->img->delete($portfolio->featured_image);
            $customName = $request->input('custom_filename') ?: 'portofolio-' . $request->title;
            $result = $this->img->uploadAndConvert($request->file('featured_image'), 'portfolios', 1920, 80, $customName);
            $data['featured_image']       = $result['path'];
            $data['featured_image_thumb'] = $result['thumb_path'];
        }

        $portfolio->update($data);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->featured_image) $this->img->delete($portfolio->featured_image);
        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil dihapus!');
    }
}
