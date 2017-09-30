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

namespace Onini\Gayly\Support\Layout;

class Row implements Build
{

	/**
	 * columns
	 * @var [type]
	 */
	protected $columns = [];

	public function __construct($content = '')
	{
		if (!empty($content)) {
			$this->column(12, $content);
		}
	}

	/**
	 * add column
	 * @method column
	 * @param  [type] $num     [description]
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
	public function column($num, $content)
	{
		$column = new Column($content, $num);

		$this->addColumn($column);
	}

	public function addColumn(Column $column)
	{
		$this->columns[] = $column;
	}

	/**
	 * build column
	 * @method build
	 * @return [type] [description]
	 */
	public function build()
	{
		$this->startRow();

		foreach ($this->columns as $column) {
			$column->build();
		}

		$this->endRow();
	}

	/**
	 * start row
	 * @method startRow
	 * @return [type]   [description]
	 */
	protected function startRow()
	{
		echo '<div class="row">';
	}

	/**
	 * end row
	 * @method endRow
	 * @return [type] [description]
	 */
	protected function endRow()
	{
		echo '</div>';
	}
}
