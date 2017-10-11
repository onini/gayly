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

class Html extends Field
{
    /**
     * Htmlable.
     *
     * @var string|\Closure
     */
    protected $html = '';

    /**
     * @var string
     */
    protected $label = '';

    protected $plain = false;

    /**
     * Create a new Html instance.
     *
     * @param mixed $html
     * @param array $arguments
     */
    public function __construct($html, $arguments)
    {
        $this->html = $html;

        $this->label = array_get($arguments, 0);
    }

    public function plain()
    {
        $this->plain = true;

        return $this;
    }

    /**
     * Render html field.
     *
     * @return string
     */
    public function render()
    {
        if ($this->html instanceof \Closure) {
            $this->html = $this->html->call($this->form->model(), $this->form);
        }

        if ($this->plain) {
            return $this->html;
        }

        return <<<EOT
<div class="form-group">
    <label  class="col-sm-{$this->width['label']} control-label">{$this->label}</label>
    <div class="col-sm-{$this->width['field']}">
        {$this->html}
    </div>
</div>
EOT;
    }
}
