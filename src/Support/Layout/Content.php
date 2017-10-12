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

use Closure;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\MessageBag;

class Content implements Renderable
{

	/**
	 * title
	 * @var [type]
	 */
	protected $title = false;

	/**
	 * description
	 * @var [type]
	 */
	protected $description = '';

	/**
	 * Rows
	 * @var [type]
	 */
	protected $rows = [];

	public function __construct(Closure $callback = null)
	{
		if ($callback instanceof Closure) {
			$callback($this);
		}
	}

	/**
	 * set title
	 * @method title
	 * @param  [type] $title [description]
	 * @return [type]        [description]
	 */
	public function title($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * set description
	 * @method description
	 * @param  [type]      $description [description]
	 * @return [type]                   [description]
	 */
	public function description($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * alias row
	 * @method body
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
	public function body($content)
	{
		return $this->row($content);
	}

	/**
	 * add row
	 * @method row
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
	public function row($content)
	{
		if ($content instanceof Closure) {
			$row = new Row();
			call_user_func($content, $row);
			$this->addRow($row);
		} else {
			$this->addRow(new Row($content));
		}

		return $this;
	}

	/**
	 * add row
	 * @method addRow
	 * @param  Row    $row [description]
	 */
	protected function addRow(Row $row)
	{
		$this->rows[] = $row;
	}

	/**
	 * build html
	 * @method build
	 * @return [type] [description]
	 */
	public function build()
	{
		ob_start();

		foreach ($this->rows as $row) {
			$row->build();
		}

		$content = ob_get_contents();

		ob_end_clean();

		return $content;
	}

	/**
     * Set error message for content.
     *
     * @param string $title
     * @param string $message
     *
     * @return $this
     */
    public function withError($title = '', $message = '')
    {
        $error = new MessageBag(compact('title', 'message'));

        session()->flash('error', $error);

        return $this;
    }

	/**
	 * render content
	 * @method render
	 * @return [type] [description]
	 */
	public function render()
	{
		$items = [
			'content'	=>	$this->build(),
		];

		if ($this->title) {
			$items['title'] = $this->title;
		}

		if ($this->description) {
			$items['description'] = $this->description;
		}

		return view('gayly::content', $items);
	}

	/**
	 * return string
	 * @method __toString
	 * @return string     [description]
	 */
	public function __toString()
	{
		return $this->render();
	}
}
