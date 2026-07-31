<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public function index()
    {
        $internships = Internship::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.internships.index', compact('internships'));
    }

    public function create()
    {
        return view('admin.internships.create');
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

        Internship::create($data);
        return redirect()->route('admin.internships.index')->with('success', 'Internship berhasil disimpan!');
    }

    public function edit(Internship $internship)
    {
        return view('admin.internships.edit', compact('internship'));
    }

    public function update(Request $request, Internship $internship)
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

        $internship->update($data);
        return redirect()->route('admin.internships.index')->with('success', 'Internship berhasil diperbarui!');
    }

    public function destroy(Internship $internship)
    {
        $internship->delete();
        return redirect()->route('admin.internships.index')->with('success', 'Internship berhasil dihapus!');
    }
}
