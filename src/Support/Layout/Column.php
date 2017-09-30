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

class Column implements Build
{
	/**
	 * col num
	 * @var [type]
	 */
    protected $num = 12;

	/**
	 * content
	 * @var [type]
	 */
    protected $contents = [];

    public function __construct($content, $num = 12)
    {
        if ($content instanceof Closure) {
            call_user_func($content, $this);
        } else {
            $this->append($content);
        }

        $this->num = $num;
    }

	/**
	 * append content to column
	 * @method append
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
    public function append($content)
    {
        $this->contents[] = $content;

        return $this;
    }

	/**
	 * add row for column
	 * @method row
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
	public function row($content)
	{
		if ($content instanceof Closure) {
			$row = new Row();
			call_user_func($content, $row);
		} else {
			$row = new Row($content);
		}

		ob_start();

		$row->build();
		$contents = ob_get_contents();

		ob_end_clean();

		return $this->append($contents);
	}

	/**
	 * build html
	 * @method build
	 * @return [type] [description]
	 */
    public function build()
    {
        $this->startColumn();

        foreach ($this->contents as $content) {
            if ($content instanceof Renderable) {
                echo $content->render();
            } else {
                echo (string) $content;
            }
        }

        $this->endCloumn();
    }

	/**
	 * start column
	 * @method startColumn
	 * @return [type]      [description]
	 */
    protected function startColumn()
    {
        echo '<div class="col-md-'.$this->num.'">';
    }

	/**
	 * end column
	 * @method endCloumn
	 * @return [type]    [description]
	 */
    protected function endCloumn()
    {
        echo '</div>';
    }
}
