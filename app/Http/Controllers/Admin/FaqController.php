<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->paginate(30);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $cities = config('cities');
        return view('admin.faqs.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question'   => 'required|string',
            'answer'     => 'required|string',
            'category'   => 'required|string|max:50',
            'city_key'   => 'nullable|string|max:50',
            'is_active'  => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil disimpan!');
    }

    public function edit(Faq $faq)
    {
        $cities = config('cities');
        return view('admin.faqs.edit', compact('faq', 'cities'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question'   => 'required|string',
            'answer'     => 'required|string',
            'category'   => 'required|string|max:50',
            'city_key'   => 'nullable|string|max:50',
            'is_active'  => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus!');
    }
}
