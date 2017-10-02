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

class CreateButton extends AbstractTool
{

	/**
	 * create button
	 * @method __constrcut
	 * @param  Grid        $grid [description]
	 * @return [type]            [description]
	 */
	public function __construct(Grid $grid)
	{
		$this->grid = $grid;
	}

	public function render()
	{
		if (!$this->grid->allowCreate()) {
			return '';
		}

		$new = trans('gayly.new');

		return <<<HTML
			<div class="pull-right">
				<button type="button" class="btn btn-success btn-xs btn-mini"><i class="fa fa-user"></i> {$new}</button>
			</div>
HTML;
	}
}
