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

/**
 * Class ListBox.
 *
 * @see https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox
 */
class Listbox extends MultipleSelect
{
    protected $settings = [];

    protected static $css = [
        // '/vendor/laravel-admin/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css',
    ];

    protected static $js = [
        // '/vendor/laravel-admin/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js',
    ];

    public function settings(array $settings)
    {
        $this->settings = $settings;

        return $this;
    }

    public function render()
    {
//         $settings = array_merge($this->settings, [
//             'infoText'          => trans('gayly.listbox.text_total'),
//             'infoTextEmpty'     => trans('gayly.listbox.text_empty'),
//             'infoTextFiltered'  => trans('gayly.listbox.filtered'),
//             'filterTextClear'   => trans('gayly.listbox.filter_clear'),
//             'filterPlaceHolder' => trans('gayly.listbox.filter_placeholder'),
//         ]);
//
//         $settings = json_encode($settings);
//
//         $this->script = <<<SCRIPT
//
// $("{$this->getElementClassSelector()}").bootstrapDualListbox($settings);
//
// SCRIPT;
//
//         return parent::render();
    }
}
