<?php

namespace LetoceilingCoder\MediaManager\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    /**
     * Применить фильтр к запросу
     *
     * @param Builder $builder
     * @return void
     */
    public function apply(Builder $builder): void;
}

