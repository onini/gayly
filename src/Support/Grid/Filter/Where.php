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

namespace Onini\Gayly\Support\Grid\Filter;

use Gayly;

class Where extends AbstractFilter
{
    /**
     * Query closure.
     *
     * @var \Closure
     */
    protected $where;

    /**
     * Input value from presenter.
     *
     * @var
     */
    public $input;

    /**
     * Where constructor.
     *
     * @param \Closure $query
     * @param string   $label
     * @param string   $column
     */
    public function __construct(\Closure $query, $label, $column = null)
    {
        $this->where = $query;

        $this->label = $this->formatLabel($label);
        $this->column = $column ?: static::getQueryHash($query, $this->label);
        $this->id = $this->formatId($this->column);

        $this->setupDefaultPresenter();
    }

    /**
     * Get the hash string of query closure.
     *
     * @param \Closure $closure
     * @param string   $label
     *
     * @return string
     */
    public static function getQueryHash(\Closure $closure, $label = '')
    {
        $reflection = new \ReflectionFunction($closure);

        return md5($reflection->getFileName().$reflection->getStartLine().$reflection->getEndLine().$label);
    }

    /**
     * Get condition of this filter.
     *
     * @param array $inputs
     *
     * @return array|mixed|void
     */
    public function condition($inputs)
    {
        $value = array_get($inputs, $this->column ?: static::getQueryHash($this->where, $this->label));

        if (is_array($value)) {
            $value = array_filter($value);
        }

        if (is_null($value) || empty($value)) {
            return;
        }

        $this->input = $this->value = $value;

        return $this->buildCondition($this->where->bindTo($this));
    }
}
