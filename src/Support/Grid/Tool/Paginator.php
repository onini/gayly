<?php
// +----------------------------------------------------------------------
// | Gayly [ GOOD GOOD STUDY DAY DAY UP ]
// +----------------------------------------------------------------------
// | Copyright (c) http://smhx.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: gayly <tthd@163.com>
// +----------------------------------------------------------------------

namespace Onini\Gayly\Support\Grid\Tool;

use Onini\Gayly\Support\Grid;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class Paginator extends AbstractTool
{
    protected $paginator = null;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;

        $this->initPaginator();
    }

    protected function initPaginator()
    {
        $this->paginator = $this->grid->model()->eloquent();
        // dump($this->paginator);
        if ($this->paginator instanceof LengthAwarePaginator) {
            $this->paginator->appends(Input::all());
        }
    }

    protected function paginationLinks()
    {
        return $this->paginator->render('gayly::paginator');
    }

	protected function perPageSelector()
	{
		return new PerPageSelector($this->grid);
	}

    protected function paginationRanger()
    {
        $parameters = [
	        'first' => $this->paginator->firstItem(),
	        'last'  => $this->paginator->lastItem(),
	        'total' => $this->paginator->total(),
	    ];

        $parameters = collect($parameters)->flatMap(function ($parameter, $key) {
            return [$key => "<b>$parameter</b>"];
        });

        return trans('gayly.pagination.range', $parameters->all());
    }

    public function render()
    {
        if (!$this->grid->usePaginator()) {
            return '';
        }

        return $this->paginationRanger().
                $this->paginationLinks().
                $this->perPageSelector();
    }
}
