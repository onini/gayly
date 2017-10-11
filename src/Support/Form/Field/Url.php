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

namespace Onini\Gayly\Support\Form\Field;

class Url extends Text
{
    protected $rules = 'url';

    public function render()
    {
        $this->prepend('<i class="fa fa-internet-explorer"></i>')
            ->defaultAttribute('type', 'url');

        return parent::render();
    }
}
