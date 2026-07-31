<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        return view('admin.seo.index');
    }

    public function update(Request $request)
    {
        $pages = ['home','about','services','portfolio','articles','contact'];
        $fields = ['meta_title','meta_description','meta_keywords'];

        foreach ($pages as $page) {
            foreach ($fields as $field) {
                $key = "{$page}_{$field}";
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key, ''), 'group' => 'seo']
                );
            }
        }

        return back()->with('success', 'SEO settings berhasil disimpan!');
    }
}
