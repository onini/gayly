<?php

namespace Onini\Gayly\Support\Grid\Filter\Field;

use Gayly;

class DateTime
{
    /**
     * @var \Onini\Gayly\Support\Grid\Filter\AbstractFilter
     */
    protected $filter;

    protected $options = [];

    protected $format = 'YYYY-MM-DD HH:mm:ss';

    public function __construct($filter, array $options = [])
    {
        $this->filter = $filter;

        $this->options = $this->checkOptions($options);

        $this->prepare();
    }

    public function prepare()
    {
        $script = "$('#{$this->filter->getId()}').datetimepicker(".json_encode($this->options).');';

        Gayly::script($script);
    }

    public function variables()
    {
        return [];
    }

    public function name()
    {
        return 'datetime';
    }

    protected function checkOptions($options)
    {
        $options['format'] = array_get($options, 'format', $this->format);
        $options['locale'] = array_get($options, 'locale', config('app.locale'));

        return $options;
    }
}
