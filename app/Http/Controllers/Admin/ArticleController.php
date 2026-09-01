<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(private ImageService $img) {}

    public function index()
    {
        $articles = Article::with('articleCategory')
            ->latest()
            ->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = ArticleCategory::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')->orderBy('name')])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function show(Article $article)
    {
        return redirect()->route('admin.articles.edit', $article);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'               => 'required|string|max:255',
            'slug'                => 'nullable|string|max:255|unique:articles,slug',
            'excerpt'             => 'nullable|string',
            'content'             => 'nullable|string',
            'category'            => 'nullable|string|max:100',
            'article_category_id' => 'nullable|exists:article_categories,id',
            'status'              => 'required|in:draft,published',
            'meta_title'          => 'nullable|string',
            'meta_description'    => 'nullable|string',
            'meta_keywords'       => 'nullable|string',
            'author_name'         => 'nullable|string|max:100',
            'featured_image'      => 'nullable|image|max:5120',
            'og_image'            => 'nullable|image|max:5120',
            'custom_filename'     => 'nullable|string|max:255',
            'faqs'                => 'nullable|array',
            'faqs.*.question'     => 'nullable|string|max:255',
            'faqs.*.answer'       => 'nullable|string',
        ]);

        $slugName = \Illuminate\Support\Str::slug($request->slug ?: $request->title);
        if ($request->hasFile('featured_image')) {
            $customName = $request->input('custom_filename') ? \Illuminate\Support\Str::slug($request->input('custom_filename')) : $slugName;
            $result = $this->img->uploadAndConvert($request->file('featured_image'), 'articles', 1920, 80, $customName);
            $data['featured_image']       = $result['path'];
            $data['featured_image_thumb'] = $result['thumb_path'];
        }

        if ($request->hasFile('og_image')) {
            $customName = ($request->input('custom_filename') ? \Illuminate\Support\Str::slug($request->input('custom_filename')) : $slugName) . '-og';
            $result = $this->img->uploadAndConvert($request->file('og_image'), 'articles/og', 1200, 85, $customName);
            $data['og_image'] = $result['path'];
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        // Clean empty faqs
        if (isset($data['faqs'])) {
            $data['faqs'] = array_values(array_filter($data['faqs'], fn($f) => !empty($f['question']) && !empty($f['answer'])));
        }

        Article::create($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil disimpan!');
    }

    public function edit(Article $article)
    {
        $categories = ArticleCategory::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')->orderBy('name')])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title'               => 'required|string|max:255',
            'slug'                => 'nullable|string|max:255|unique:articles,slug,' . $article->id,
            'excerpt'             => 'nullable|string',
            'content'             => 'nullable|string',
            'category'            => 'nullable|string|max:100',
            'article_category_id' => 'nullable|exists:article_categories,id',
            'status'              => 'required|in:draft,published',
            'meta_title'          => 'nullable|string',
            'meta_description'    => 'nullable|string',
            'meta_keywords'       => 'nullable|string',
            'author_name'         => 'nullable|string|max:100',
            'featured_image'      => 'nullable|image|max:5120',
            'og_image'            => 'nullable|image|max:5120',
            'custom_filename'     => 'nullable|string|max:255',
            'faqs'                => 'nullable|array',
            'faqs.*.question'     => 'nullable|string|max:255',
            'faqs.*.answer'       => 'nullable|string',
        ]);

        $slugName = \Illuminate\Support\Str::slug($request->slug ?: $request->title);
        if ($request->hasFile('featured_image')) {
            if ($article->featured_image) $this->img->delete($article->featured_image);
            $customName = $request->input('custom_filename') ? \Illuminate\Support\Str::slug($request->input('custom_filename')) : $slugName;
            $result = $this->img->uploadAndConvert($request->file('featured_image'), 'articles', 1920, 80, $customName);
            $data['featured_image']       = $result['path'];
            $data['featured_image_thumb'] = $result['thumb_path'];
        }

        if ($request->hasFile('og_image')) {
            if ($article->og_image) $this->img->delete($article->og_image);
            $customName = ($request->input('custom_filename') ? \Illuminate\Support\Str::slug($request->input('custom_filename')) : $slugName) . '-og';
            $result = $this->img->uploadAndConvert($request->file('og_image'), 'articles/og', 1200, 85, $customName);
            $data['og_image'] = $result['path'];
        }

        if ($data['status'] === 'published' && !$article->published_at) {
            $data['published_at'] = now();
        }

        // Clean empty faqs
        if (isset($data['faqs'])) {
            $data['faqs'] = array_values(array_filter($data['faqs'], fn($f) => !empty($f['question']) && !empty($f['answer'])));
        } else {
            $data['faqs'] = null; // if all removed
        }

        $article->update($data);
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        if ($article->featured_image) $this->img->delete($article->featured_image);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
