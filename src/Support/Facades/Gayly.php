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

namespace Onini\Gayly\Support\Facades\Gayly;

use Illuminate\Support\Facades\Facade;

class Gayly extends Facade
{
	protected static function getFacadeAccessor()
	{
		return \Onini\Gayly\Support\Gayly::class;
	}
}
