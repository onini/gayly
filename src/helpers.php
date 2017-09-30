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

if (!function_exists('gayly_path')) {
    /**
     * Get gayly path.
     *
     * @param string $path
     *
     * @return string
     */
    function gayly_path($path = '')
    {
        return ucfirst(config('gayly.directory')).($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (!function_exists('gayly_url')) {
    /**
     * Get gayly url.
     *
     * @param string $path
     *
     * @return string
     */
    function gayly_url($path = '')
    {
        return url(gayly_base_path($path));
    }
}

if (!function_exists('gayly_base_path')) {
    /**
     * Get gayly url.
     *
     * @param string $path
     *
     * @return string
     */
    function gayly_base_path($path = '')
    {
        $prefix = '/'.trim(config('gayly.route.prefix'), '/');
        $prefix = ($prefix == '/') ? '' : $prefix;
        return $prefix.'/'.trim($path, '/');
    }
}

if (!function_exists('gayly_toastr')) {
    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     *
     * @return string
     */
    function gayly_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new \Illuminate\Support\MessageBag(get_defined_vars());
        \Illuminate\Support\Facades\Session::flash('toastr', $toastr);
    }
}

if (!function_exists('gayly_asset')) {
    /**
     * @param $path
     *
     * @return string
     */
    function gayly_asset($path)
    {
        return asset($path, config('gayly.secure'));
    }
}

if (!function_exists('gayly_layout')) {

	function gayly_layout()
	{
		$layout = config('gayly.layout', 'simple');
		return \Onini\Gayly\Support\Facades\Gayly::css();
	}
}

if (!function_exists('gayly_error')) {

    function gayly_error($data, $code = 403)
    {
        if (request()->ajax() && (request()->getMethod() != 'GET')) {
            return response()->json($data, $code);
        } else {
            return response()->view('gayly::errors.default', $data);
        }
    }
}
