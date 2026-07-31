<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Services\SeoService;
use App\Services\SchemaService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(
        private SeoService    $seo,
        private SchemaService $schema
    ) {}

    public function index(Request $request): View
    {
        // Load all parent categories with children for the filter panel
        $parentCategories = ArticleCategory::with(['children' => fn($q) => $q->active()->ordered()])
            ->active()
            ->parents()
            ->ordered()
            ->withCount(['articles' => fn($q) => $q->published()])
            ->get();

        $query = Article::published()->with('articleCategory.parent');

        // ─── Search ───────────────────────────────────────────────
        $search = $request->get('q');
        if ($search) {
            $query->where(fn($q) =>
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
            );
        }

        // ─── Category filter ──────────────────────────────────────
        $activeCategory = null;
        $categorySlug   = $request->get('kategori');
        if ($categorySlug) {
            $activeCategory = ArticleCategory::where('slug', $categorySlug)->first();
            if ($activeCategory) {
                // If parent: include all children too
                if ($activeCategory->isParent()) {
                    $childIds = $activeCategory->children()->pluck('id')->push($activeCategory->id);
                    $query->whereIn('article_category_id', $childIds);
                } else {
                    $query->where('article_category_id', $activeCategory->id);
                }
            }
        }

        // ─── Sort ─────────────────────────────────────────────────
        $sort = $request->get('sort', 'newest');
        match ($sort) {
            'popular' => $query->orderBy('views', 'desc'),
            'oldest'  => $query->orderBy('published_at', 'asc'),
            default   => $query->orderBy('published_at', 'desc'),
        };

        $articles = $query->paginate(9)->withQueryString();

        $seo = $this->seo->forPage('articles', [
            'title'       => $activeCategory
                ? $activeCategory->meta_title . ' — ' . setting('articles_meta_title', 'Artikel HVM Digital')
                : setting('articles_meta_title', 'Blog & Artikel Digital Marketing | HVM Digital'),
            'description' => $activeCategory?->meta_description
                ?: setting('articles_meta_description', 'Tips, strategi, dan insight digital marketing, pembuatan website, dan IT solution dari tim HVM Digital.'),
            'keywords'    => setting('articles_meta_keywords', 'blog digital marketing, artikel website, tips SEO, insight IT solution, HVM Digital blog'),
            'schemas'     => [$this->schema->organization()],
        ]);

        return view('articles.index', compact(
            'seo', 'articles', 'search',
            'parentCategories', 'activeCategory', 'sort'
        ));
    }

    public function show(Article $article): View
    {
        if ($article->status !== 'published') {
            abort(404);
        }

        $article->incrementViews();
        $article->load('articleCategory.parent');

        $related = Article::published()
            ->where('id', '!=', $article->id)
            ->where(function ($q) use ($article) {
                if ($article->article_category_id) {
                    $q->where('article_category_id', $article->article_category_id);
                } elseif ($article->category) {
                    $q->where('category', $article->category);
                }
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        // Fallback: if no related in same category, get latest articles
        if ($related->isEmpty()) {
            $related = Article::published()
                ->where('id', '!=', $article->id)
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        $seo = $this->seo->forArticle($article);

        // 1. Reading Time & Word Count
        $parsedHtml = \Illuminate\Support\Str::markdown($article->content ?? '');
        $wordCount = str_word_count(strip_tags($parsedHtml));
        $article->reading_time = max(1, ceil($wordCount / 200));
        $article->word_count = $wordCount;

        // 2. Server-Side TOC Parser & Heading ID injection
        $toc = [];
        $index = 0;
        $parsedHtml = preg_replace_callback('/<(h[23])>(.*?)<\/\1>/s', function ($matches) use (&$toc, &$index) {
            $tag = $matches[1];
            $text = $matches[2];
            $id = \Illuminate\Support\Str::slug(strip_tags($text)) ?: 'heading-' . $index;
            $toc[] = [
                'level' => (int) substr($tag, 1),
                'title' => strip_tags($text),
                'id'    => $id,
            ];
            $index++;
            return "<{$tag} id=\"{$id}\">{$text}</{$tag}>";
        }, $parsedHtml);

        // 3. Auto-inject Internal Link (Baca Juga) & AEO Key Takeaways
        if ($related->isNotEmpty()) {
            $bacaJuga = $related->first();
            $bacaJugaHtml = '<div class="my-8 p-5 bg-card dark:bg-card-dark border-l-4 border-lime shadow-sm rounded-r-xl"><span class="font-bold text-lime-dark dark:text-lime">Baca Juga:</span> <a href="'.route('articles.show', $bacaJuga->slug).'" class="font-semibold text-fg hover:text-lime transition-colors underline decoration-lime/30 underline-offset-4">'.$bacaJuga->title.'</a></div>';
            
            // Generate AEO Key Takeaways (Poin Penting) from TOC
            $keyTakeawaysHtml = '';
            if (count($toc) >= 2) {
                $takeaways = collect($toc)->filter(fn($item) => $item['level'] === 2)->take(5)->map(fn($item) => '<li><a href="#' . $item['id'] . '" class="hover:text-lime transition-colors">' . $item['title'] . '</a></li>')->implode('');
                if (!empty($takeaways)) {
                    $keyTakeawaysHtml = '<div class="my-8 p-6 bg-[#f0fdf4] dark:bg-[#0d1f15] border border-lime/20 shadow-md rounded-2xl"><h3 class="font-bold text-lg text-lime-dark dark:text-lime mb-3 flex items-center gap-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> Poin Penting (Key Takeaways)</h3><ul class="list-disc list-inside space-y-2 text-fg/80 dark:text-gray-300">' . $takeaways . '</ul></div>';
                }
            }

            $paragraphs = explode('</p>', $parsedHtml);
            
            // Insert Key Takeaways before the very first paragraph
            if (!empty($keyTakeawaysHtml) && count($paragraphs) > 1) {
                array_splice($paragraphs, 0, 0, $keyTakeawaysHtml);
            }
            
            // Insert Baca Juga after the 3rd paragraph (or at the end if fewer)
            if (count($paragraphs) > 3) {
                array_splice($paragraphs, 3, 0, $bacaJugaHtml);
            } else {
                $paragraphs[] = $bacaJugaHtml;
            }
            
            $parsedHtml = implode('</p>', $paragraphs);
        }
        
        // 4. SEO Core Web Vitals: Auto-inject loading="lazy" to all images
        $parsedHtml = preg_replace('/<img(?![^>]*loading=)/i', '<img loading="lazy"', $parsedHtml);

        $article->parsed_content = $parsedHtml;
        $article->toc = $toc;

        return view('articles.show', compact('seo', 'article', 'related'));
    }
}
