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

namespace Onini\Gayly\Support\Form;

use Onini\Gayly\Support\Form;
use Illuminate\Contracts\Support\Renderable;

class Row implements Renderable
{
    /**
     * Callback for add field to current row.s.
     *
     * @var \Closure
     */
    protected $callback;

    /**
     * Parent form.
     *
     * @var Form
     */
    protected $form;

    /**
     * Fields in this row.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Default field width for appended field.
     *
     * @var int
     */
    protected $defaultFieldWidth = 8;

    /**
     * Default offset.
     * @var [type]
     */
    protected $defaultOffset = 2;

    /**
     * Row constructor.
     *
     * @param \Closure $callback
     * @param Form     $form
     */
    public function __construct(\Closure $callback, Form $form)
    {
        $this->callback = $callback;

        $this->form = $form;

        call_user_func($this->callback, $this);
    }

    /**
     * Set width for a incomming field.
     *
     * @param int $width
     *
     * @return $this
     */
    public function width($width = 8)
    {
        $this->defaultFieldWidth = $width;

        return $this;
    }

    public function offset($offset = 2)
    {
        $this->defaultOffset = $offset;

        return $this;
    }

    /**
     * Render the row.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view('gayly::form.row', ['fields' => $this->fields]);
    }

    public function form()
    {
        return $this->form;
    }

    /**
     * Add field.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return Field|void
     */
    public function __call($method, $arguments)
    {
        $field = $this->form->__call($method, $arguments);

        $field->disableHorizontal();

        $this->fields[] = [
            'width'   => $this->defaultFieldWidth,
            'offset'  => $this->defaultOffset,
            'element' => $field,
        ];

        return $field;
    }
}
