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

use Onini\Gayly\Support\Form\Field;

class Slider extends Field
{
    protected static $css = [
        '/vendor/gayly/assets/plugins/ionrangeSlider/css/ion.rangeSlider.css',
        '/vendor/gayly/assets/plugins/ionrangeSlider/css/ion.rangeSlider.skinNice.css',
    ];

    protected static $js = [
        '/vendor/gayly/assets/plugins/ionrangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js',
    ];

    protected $options = [
        'type'     => 'single',
        'prettify' => false,
        'hasGrid'  => true,
    ];

    public function render()
    {
        $option = json_encode($this->options);

        $this->script = "$('{$this->getElementClassSelector()}').ionRangeSlider($option)";

        return parent::render();
    }
}
