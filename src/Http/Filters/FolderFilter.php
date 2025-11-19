<?php

namespace LetoceilingCoder\MediaManager\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class FolderFilter extends AbstractFilter
{
    public const NAME = 'name';

    /**
     * Получить колбэки для фильтрации
     *
     * @return array
     */
    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
        ];
    }

    /**
     * Фильтр по имени папки
     *
     * @param Builder $builder
     * @param mixed $value
     * @return void
     */
    public function name(Builder $builder, $value): void
    {
        $builder->where('name', 'like', "%{$value}%");
    }
}

