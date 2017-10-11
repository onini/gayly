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

class Email extends Text
{
    protected $rules = 'email';

    public function render()
    {
        $this->prepend('<i class="fa fa-envelope"></i>')
            ->defaultAttribute('type', 'email');

        return parent::render();
    }
}
