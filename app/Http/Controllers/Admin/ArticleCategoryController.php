<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $categories = ArticleCategory::with('children')
            ->withCount(['articles' => fn($q) => $q->published()])
            ->parents()
            ->ordered()
            ->get();
        return view('admin.article-categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = ArticleCategory::active()->parents()->ordered()->get();
        return view('admin.article-categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:120',
            'parent_id'        => 'nullable|exists:article_categories,id',
            'description'      => 'nullable|string|max:500',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:320',
            'color'            => 'nullable|string|max:20',
            'sort_order'       => 'nullable|integer|min:0',
            'is_active'        => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);

        ArticleCategory::create($data);
        return redirect()->route('admin.article-categories.index')
                         ->with('success', 'Kategori berhasil dibuat!');
    }

    public function edit(ArticleCategory $articleCategory)
    {
        $parents = ArticleCategory::active()->parents()
            ->where('id', '!=', $articleCategory->id)
            ->ordered()->get();
        return view('admin.article-categories.edit', compact('articleCategory', 'parents'));
    }

    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:120',
            'parent_id'        => 'nullable|exists:article_categories,id',
            'description'      => 'nullable|string|max:500',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:320',
            'color'            => 'nullable|string|max:20',
            'sort_order'       => 'nullable|integer|min:0',
            'is_active'        => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);

        $articleCategory->update($data);
        return redirect()->route('admin.article-categories.index')
                         ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        // Move children to top-level before deleting parent
        $articleCategory->children()->update(['parent_id' => null]);
        $articleCategory->delete();
        return redirect()->route('admin.article-categories.index')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}
