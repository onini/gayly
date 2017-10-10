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

namespace Onini\Gayly\Support\Grid\Filter\Presenter;

use Gayly;
use Illuminate\Contracts\Support\Arrayable;

class Radio extends Presenter
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * Display inline.
     *
     * @var bool
     */
    protected $inline = true;

    /**
     * Radio constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }

        $this->options = (array) $options;

        return $this;
    }

    /**
     * Draw stacked radios.
     *
     * @return $this
     */
    public function stacked() : Radio
    {
        $this->inline = false;

        return $this;
    }

    protected function prepare() : void
    {
        $script = "$('.{$this->filter->getId()}').iCheck({radioClass:'iradio_minimal-blue'});";

        Gayly::script($script);
    }

    /**
     * @return array
     */
    public function variables() : array
    {
        $this->prepare();

        return [
            'options' => $this->options,
            'inline'  => $this->inline,
        ];
    }
}
