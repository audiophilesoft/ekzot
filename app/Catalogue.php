<?php

namespace App;

use Illuminate\Database\Eloquent\{
    Collection, Model
};

class Catalogue extends Model
{
    // todo: delegate sorting to a special class

    protected $sort_by = [
        ['rank', 'desc'],
        ['created_at', 'desc'],
    ];

    protected $articles_sorted;


    public function getRouteKeyName()
    {
        return 'url';
    }


    public function articles()
    {
        return $this->hasMany(Article::class)->withCount('comments');
    }


    public function getSortBy(): array
    {
        return $this->sort_by;
    }


    public function setSortBy(array $sort_by): self
    {
        $this->sort_by = [$sort_by];
        return $this;
    }


    protected function sort(): self
    {
        $articles = $this->articles();

        foreach ($this->getSortBy() as $rule) {
            $articles = $articles->orderBy($rule[0], $rule[1]);
        }

        $this->articles_sorted = $articles;

        return $this;
    }


    public function getArticlesSorted(int $start = 0, int $limit = null): Collection
    {
        $this->sort();
        return $this->articles_sorted->skip($start)->take($limit)->get();
    }


    public function remainingNumber(int $stock)
    {
        $diff = $this->articles()->count() - $stock;
        return ($diff >= 0) ? $diff : 0;
    }
}
