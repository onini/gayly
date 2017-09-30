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

namespace Onini\Gayly\Middleware;

use Closure;
use Gayly;
use Illuminate\Http\Request;
use Onini\Gayly\Models\OperationLog as Operation;
use Illuminate\Support\Str;

class OperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldLogOperation($request)) {
            $log = [
                'user_id' => Gayly::user()->id,
                'path'    => $request->path(),
                'method'  => $request->method(),
                'ip'      => $request->getClientIp(),
                'input'   => json_encode($request->input()),
            ];

            Operation::create($log);
        }

        return $next($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function shouldLogOperation(Request $request)
    {
        return config('gayly.operation_log.enable')
            && !$this->inExceptArray($request)
            && Gayly::user();
    }

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach (config('gayly.operation_log.except') as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            $methods = [];

            if (Str::contains($except, ':')) {
                list($methods, $except) = explode(':', $except);
                $methods = explode(',', $methods);
            }

            $methods = array_map('strtoupper', $methods);

            if ($request->is($except) &&
                (empty($method) || in_array($request->method(), $methods))) {
                return true;
            }
        }

        return false;
    }
}
