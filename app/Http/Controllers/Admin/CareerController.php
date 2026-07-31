<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'division'       => 'required|string|max:255',
            'location'       => 'required|string|max:255',
            'duration'       => 'required|string|max:255',
            'custom_link'    => 'nullable|string|max:255',
            'qualifications' => 'required|string',
            'jobdesc'        => 'required|string',
            'is_active'      => 'boolean',
            'sort_order'     => 'nullable|integer',
            'seo_title'      => 'nullable|string|max:255',
            'seo_description'=> 'nullable|string|max:320',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        Career::create($data);
        return redirect()->route('admin.careers.index')->with('success', 'Karir berhasil disimpan!');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'division'       => 'required|string|max:255',
            'location'       => 'required|string|max:255',
            'duration'       => 'required|string|max:255',
            'custom_link'    => 'nullable|string|max:255',
            'qualifications' => 'required|string',
            'jobdesc'        => 'required|string',
            'is_active'      => 'boolean',
            'sort_order'     => 'nullable|integer',
            'seo_title'      => 'nullable|string|max:255',
            'seo_description'=> 'nullable|string|max:320',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $career->update($data);
        return redirect()->route('admin.careers.index')->with('success', 'Karir berhasil diperbarui!');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('admin.careers.index')->with('success', 'Karir berhasil dihapus!');
    }
}
