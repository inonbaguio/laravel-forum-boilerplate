<?php


namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request, $builder;

    protected $filters = [];
    /**
     * ThreadsFilter constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $builder;
    }

    /**
     * @param $filter
     *
     * @return bool
     */
    protected function hasFilter($filter): bool
    {
        return  $this->request->has($filter);
    }

    /**
     * @return array
     */
    protected function getFilters(): array
    {
        return $this->request->intersect($this->filters);
    }
}