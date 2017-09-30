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

namespace Onini\Gayly\Support;

use Auth;
use Closure;
use Onini\Gayly\{
	Support\Layout\Content,
	Models\Menu
};

class Gayly
{

	public static $css = [];

	public static $js = [];

	public static $script = [];

	protected static $extension = [];

	public function content(Closure $callable = null)
	{
		return new Content($callable);
	}

	public function user()
	{
		return Auth::guard('gayly')->user();
	}

	public function title()
	{
		return config('gayly.title');
	}

	public function menu()
	{
		return (new Menu())->toTree();
	}

	public static function css($css = null)
	{
		if (!is_null($css)) {
            self::$css = array_merge(self::$css, (array) $css);

            return;
        }

        static::$css = array_merge(static::$css, (array) $css);
        return view('gayly::partials.css', ['css' => array_unique(static::$css)]);
	}

	public static function js($js = null)
	{
		if (!is_null($js)) {
            self::$js = array_merge(self::$js, (array) $js);

            return;
        }

        static::$js = array_merge(static::$js, (array) $js);
        return view('gayly::partials.js', ['js' => array_unique(static::$js)]);
	}

	public static function script($script = '')
	{
		if (!empty($script)) {
			self::$script = array_merge(self::$script, $script);

			return;
		}

		return view('gayly::partials.script', ['script' => array_unique(self::$script)]);
	}

	public static function extension($key, $class)
	{
		static::$extension[$key] = $class;
	}
}
