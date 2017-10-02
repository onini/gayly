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

namespace Onini\Gayly\Support\Grid;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Onini\Gayly\Support\Grid;
use Onini\Gayly\Support\Grid\Tool\RefreshButton;
use Onini\Gayly\Support\Grid\Tool\AbstractTool;

class Tool implements Renderable
{

	/**
	 * grid
	 * @var [type]
	 */
	protected $grid;

	/**
	 * collection tools
	 * @var [type]
	 */
	protected $tool;

	public function __construct(Grid $grid)
	{
		$this->grid = $grid;

		$this->tool = new Collection();

		$this->defaultTool();
	}

	protected function defaultTool()
	{
		$this->append(new RefreshButton());
	}

	/**
	 * append tool
	 * @method append
	 * @param  [type] $tool [description]
	 * @return [type]       [description]
	 */
	public function append($tool)
	{
		$this->tool->push($tool);

		return $this;
	}

	/**
	 * prepend tool
	 * @method prepend
	 * @param  [type]  $tool [description]
	 * @return [type]        [description]
	 */
	public function prepend($tool)
	{
		$this->tool->prepend($tool);

		return $this;
	}

	/**
	 * tool bar
	 * @method render
	 * @return [type] [description]
	 */
	public function render()
	{
		return $this->tool->map(function ($tool) {
            if ($tool instanceof AbstractTool) {
                return $tool->setGrid($this->grid)->render();
            }

            return (string) $tool;
        })->implode(' ');
	}
}
