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

namespace Onini\Gayly\Traits;

use Closure;
use Onini\Gayly\Support\Grid;
use Onini\Gayly\Support\Form;
use Onini\Gayly\Support\tree;

/**
 *
 */
trait Builder
{

	/**
	 * [grid description]
	 * @method grid
	 * @param  Closure $callback [description]
	 * @return [type]            [description]
	 */
    public static function grid(Closure $callback)
    {
        return new Grid(new static(), $callback);
    }

	/**
	 * [form description]
	 * @method form
	 * @param  Closure $callback [description]
	 * @return [type]            [description]
	 */
    public static function form(Closure $callback)
    {
        return new Form(new static(), $callback);
    }

	/**
	 * [tree description]
	 * @method tree
	 * @param  [type] $callback [description]
	 * @return [type]           [description]
	 */
    public static function tree(Closure $callback = null)
    {
        return new Tree(new static(), $callback);
    }
}
