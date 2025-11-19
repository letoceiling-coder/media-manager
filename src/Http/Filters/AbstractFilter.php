<?php

namespace LetoceilingCoder\MediaManager\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterInterface
{
    /** @var array */
    private $queryParams = [];

    /**
     * AbstractFilter constructor.
     *
     * @param array $queryParams
     */
    public function __construct(array $queryParams)
    {
        $this->queryParams = $queryParams;
    }

    /**
     * Получить массив колбэков для фильтрации
     *
     * @return array
     */
    abstract protected function getCallbacks(): array;

    /**
     * Применить фильтр
     *
     * @param Builder $builder
     * @return void
     */
    public function apply(Builder $builder): void
    {
        $this->before($builder);

        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->queryParams[$name])) {
                call_user_func($callback, $builder, $this->queryParams[$name]);
            }
        }
    }

    /**
     * Метод вызывается перед применением фильтров
     *
     * @param Builder $builder
     * @return void
     */
    protected function before(Builder $builder): void
    {
        // Переопределить в дочерних классах при необходимости
    }

    /**
     * Получить параметр запроса
     *
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function getQueryParam(string $key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    /**
     * Удалить параметры запроса
     *
     * @param string[] $keys
     *
     * @return AbstractFilter
     */
    protected function removeQueryParam(string ...$keys): self
    {
        foreach ($keys as $key) {
            unset($this->queryParams[$key]);
        }

        return $this;
    }
}

