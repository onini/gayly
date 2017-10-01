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

namespace Onini\Gayly\Exception;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class Handler
{
    /**
     * Render exception.
     *
     * @param \Exception $exception
     *
     * @return string
     */
    public static function renderException(\Exception $exception)
    {
        $error = new MessageBag([
            'type'      => get_class($exception),
            'message'   => $exception->getMessage(),
            'file'      => $exception->getFile(),
            'line'      => $exception->getLine(),
        ]);

        $errors = new ViewErrorBag();
        $errors->put('exception', $error);

        return view('admin::partials.exception', compact('errors'))->render();
    }

    /**
     * Flash a error message to content.
     *
     * @param string $title
     * @param string $message
     *
     * @return mixed
     */
    public static function error($title = '', $message = '')
    {
        $error = new MessageBag(compact('title', 'message'));
        return session()->flash('error', $error);
    }
}
