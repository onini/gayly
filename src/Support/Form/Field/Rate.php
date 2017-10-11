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

class Rate extends Text
{
    public function render()
    {
        $this->prepend('')
            ->append('%')
            ->defaultAttribute('style', 'text-align:right;')
            ->defaultAttribute('placeholder', 0);

        return parent::render();
    }
}