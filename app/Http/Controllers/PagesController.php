<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Catalogue;
use App\Page;
use Illuminate\Http\Request;

class PagesController extends EntriesControllerAbstract
{


    public function index(int $limit = null)
    {

        $cat = Catalogue::where('url', config('site.home.cat_to_show'))->first();

        if (null === $limit) {
            $limit =  config('site.home.entries_limit');
        }

        $entries = $cat->getArticlesSorted(0, $limit);

        $remaining = $cat->remainingNumber($limit);
        $modifier = 'main';

        return view($this->getTemplatesFolder() . '.index', compact('entries', 'remaining', 'modifier'));
    }


    public function create(Page $page)
    {
        return $this->doCreate($page);
    }


    public function store(Request $request, Page $page)
    {
        return $this->doStore($request, $page);
    }


    public function show(Page $page)
    {
        return $this->doShow($page);
    }


    public function edit(Page $page)
    {
        return $this->doEdit($page);
    }


    public function delete(Page $page)
    {
        return $this->doDelete($page);
    }


    protected static function getChecks(bool $update_mode): array
    {
        return parent::{__FUNCTION__}(...\func_get_args()) + [
                // additional checks here
            ];
    }


    protected static function getTemplatesFolder(): string
    {
        return 'pages';
    }


    protected static function getRoutePrefix(): string
    {
        return 'page';
    }


    protected static function getTargetClass(): string
    {
        return Page::class;
    }


}
