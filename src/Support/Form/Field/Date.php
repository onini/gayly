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

class Date extends Text
{
    protected static $css = [
    ];

    protected static $js = [
    ];

    protected $format = 'YYYY-MM-DD';

    public function format($format)
    {
        $this->format = $format;

        return $this;
    }

    public function prepare($value)
    {
        if ($value === '') {
            $value = null;
        }

        return $value;
    }

    public function render()
    {
        // $this->options['format'] = $this->format;
        // $this->options['locale'] = config('app.locale');
        //
        // $this->script = "$('{$this->getElementClassSelector()}').datetimepicker(".json_encode($this->options).');';
        //
        // $this->prepend('<i class="fa fa-calendar"></i>')
        //     ->defaultAttribute('style', 'width: 110px');
        //
        // return parent::render();
    }
}
