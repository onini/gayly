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

class Gayly
{

	public static $css = [];

	public static $js = [];

	public static $script = [];

	protected static $extension = [];

	public function content()
	{

	}

	public function user()
	{
		return Auth::guard(admin)->user();
	}

	public function title()
	{
		return config('admin.title');
	}

	public static function css($css = null)
	{
		if (!is_null($css)) {
			self::$css = array_merge(self::$css, (array) $css);

			return;
		}

		static::$css = array_merge(static::$css, $css);

		return view('gayly::partials.css', ['css' => array_unique(static::$css)]);
	}

	public static function js($js = null)
	{
		if (!is_null($js)) {
			self::$js = array_merge(self::$js, (array) $js);

			return;
		}

		static::$js = array_merge(static::$js, $js);

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
