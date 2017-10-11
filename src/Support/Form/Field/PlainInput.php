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

trait PlainInput
{
    protected $prepend;

    protected $append;

    public function prepend($string)
    {
        if (is_null($this->prepend)) {
            $this->prepend = $string;
        }

        return $this;
    }

    public function append($string)
    {
        if (is_null($this->append)) {
            $this->append = $string;
        }

        return $this;
    }

    protected function initPlainInput()
    {
        if (empty($this->view)) {
            $this->view = 'gayly::form.input';
        }
    }

    protected function defaultAttribute($attribute, $value)
    {
        if (!array_key_exists($attribute, $this->attributes)) {
            $this->attribute($attribute, $value);
        }

        return $this;
    }
}
