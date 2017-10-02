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

use Gayly;
use Onini\Gayly\Support\Grid;

class PerPageSelector extends AbstractTool
{
    protected $perPage;

    protected $perPageName = '';

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;

		$this->initialize();
    }

    protected function initialize()
    {
        $this->perPageName = $this->grid->model()->getPerPageName();

        $this->perPage = (int) app('request')->input(
            $this->perPageName,
            $this->grid->perPage
        );
    }

    public function getOptions()
    {
        return collect($this->grid->perPages)
        ->push($this->grid->perPage)
        ->push($this->perPage)
        ->unique()
        ->sort();
    }

	public function render()
	{
		return '';
	}

	protected function script()
	{
		return '';
	}
}
