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
use Illuminate\Contracts\Support\Renderable;

abstract class AbstractTool implements Renderable
{

	/**
	 * Onini\Gayly\Support\Grid
	 * @var [type]
	 */
	protected $grid;

	/**
	 * set grid
	 * @method setGrid
	 * @param  Grid    $grid [description]
	 */
	public function setGrid(Grid $grid)
	{
		$this->grid = $grid;

		return $this;
	}

	/**
	 * [abstract description]
	 * @var [type]
	 */
	abstract public function render();

	/**
	 * to sstring
	 * @method __toString
	 * @return string     [description]
	 */
	public function __toString()
	{
		return $this->render();
	}
}
