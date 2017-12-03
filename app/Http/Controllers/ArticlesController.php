<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Article;
use App\Catalogue;
use App\Entry;
use Illuminate\Http\Request;

class ArticlesController extends EntriesControllerAbstract
{

    protected static $sorting_map = [
        'title' => 'title',
        'views' => 'views_count',
        'comments' => 'comments_count',
        'date' => 'created_at'
    ];


    protected function sortCatalogue(Catalogue $catalogue)
    {
        $sort_by = self::$sorting_map[$this->getSortByFront()];
        $order = $this->getOrderByFront();
        $catalogue->setSortBy([$sort_by, $order]);
    }


    protected function getSortByFront(): string
    {
        return request()->get('sort_by') ?? 'date';
    }


    protected function getOrderByFront(): string
    {
        return request()->get('order') === 'asc' ? 'asc' : 'desc';
    }


    public function create(Request $request, Article $article)
    {
        return $this->doCreate($article);
    }


    public function store(Request $request, Article $article)
    {
        $article->user_id = \Auth::user()->id;
        return $this->doStore($request, $article);
    }


    public function showCat(Catalogue $catalogue, int $limit = null)
    {
        if (null === $limit) {
            $limit = config('site.articles.catalogue_entries_limit');
        }

        $this->sortCatalogue($catalogue);
        $entries = $catalogue->getArticlesSorted(0, $limit);
        $modifier = 'catalogue';
        $sort_by = $this->getSortByFront();
        $order = $this->getOrderByFront();
        $remaining = $catalogue->remainingNumber($limit);

        return view('articles.catalogue', compact('catalogue', 'entries', 'modifier', 'sort_by', 'order', 'remaining'));
    }


    public function loadMoreInCat(Catalogue $catalogue, Request $request)
    {
        if (!$request->ajax()) {
            return $this->showCat($catalogue, PHP_INT_MAX);
        }

        $this->sortCatalogue($catalogue);
        $start = config('site.articles.catalogue_entries_limit');
        $entries = $catalogue->getArticlesSorted($start, PHP_INT_MAX);
        $ajax = true;
        $modifier = 'catalogue';

        return view('articles.items', compact('entries', 'ajax', 'catalogue', 'modifier'));
    }


    public function loadMoreOnMain(Request $request)
    {
        // todo: This is not good. Think how to rework
        if (!$request->ajax()) {
            return app(PagesController::class)->index(PHP_INT_MAX);
        }

        $loaded = config('site.home.entries_limit');
        $catalogue = Catalogue::where('url', config('site.home.cat_to_show'))->first();
        $entries = $catalogue->getArticlesSorted($loaded, null);
        $modifier = 'main';

        return view('articles.items', compact('entries', 'modifier'));
    }


    public function show(Catalogue $catalogue, Article $article)
    {

        if ($catalogue->id !== $article->catalogue->id) {
            return \Redirect::to(route('articles.show', [$article->catalogue, $article]), 301);
        }


        return $this->doShow($article);
    }


    public function edit(Article $page)
    {
        return $this->doEdit($page);
    }


    public function delete(Article $page)
    {
        return $this->doDelete($page);
    }


    public function getCats()
    {
        return Catalogue::all()->sortBy('number');
    }


    protected static function getChecks(bool $update_mode): array
    {
        return parent::{__FUNCTION__}(...\func_get_args()) + [
                'description' => 'max:4096',
                'show_on_main' => 'nullable|max:3',
                'enable_comments' => 'nullable|max:3',
                'rank' => 'nullable|numeric|max:127|min:-128'
            ];
    }


    protected static function getTemplatesFolder(): string
    {
        return 'articles';
    }


    protected static function getRoutePrefix(): string
    {
        return 'article';
    }


    protected static function getTargetClass(): string
    {
        return Article::class;
    }


    protected function setDefaults(Entry $entry)
    {
        parent::setDefaults($entry);
        $entry->enable_comments = true;
        $entry->show_on_main = false;
    }

}
