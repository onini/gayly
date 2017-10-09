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

namespace Onini\Gayly\Support\Grid\Tool;

abstract class AbstractAction
{

	protected $id;

	protected $resource;

	public function setId($id)
    {
        $this->id = $id;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    public function getToken()
    {
        return csrf_token();
    }

    protected function getElementClass()
    {
        return '.gayly-action-'.$this->id;
    }

    abstract public function script();
}
