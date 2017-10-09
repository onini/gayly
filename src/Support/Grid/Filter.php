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

namespace Onini\Gayly\Support\Grid;

use Onini\Gayly\Support\Grid\Filter\AbstractFilter;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Gayly;

class Filter
{

	protected $model;

	protected $supports = [
        'equal', 'notEqual', 'ilike', 'like', 'gt', 'lt', 'between',
        'where', 'in', 'notIn', 'date', 'day', 'month', 'year',
    ];

    protected $filters = [];

    protected $action;

    protected $useIdFilter = true;

    protected $view = 'gayly::filter.modal';

	public function __construct(Model $model)
	{
		$this->model = $model;

		$pk = $this->model->eloquent()->getKeyName();
		$this->equal($pk, strtoupper($pk));
	}

	public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

	public function disableIdFilter()
    {
        $this->useIdFilter = false;
    }

	public function conditions()
    {
        $inputs = array_dot(Input::all());

        $inputs = array_filter($inputs, function ($input) {
            return $input !== '' && !is_null($input);
        });

        if (empty($inputs)) {
            return [];
        }

        $params = [];

        foreach ($inputs as $key => $value) {
            array_set($params, $key, $value);
        }

        $conditions = [];

        foreach ($this->filters() as $filter) {
            $conditions[] = $filter->condition($params);
        }

        return array_filter($conditions);
    }

	public function addFilter(AbstractFilter $filter)
    {
        $filter->setParent($this);

        return $this->filters[] = $filter;
    }

	public function filters()
    {
        return $this->filters;
    }

	public function execute()
    {
        return $this->model->addConditions($this->conditions())->buildData();
    }

	public function render()
	{
		if (!$this->useIdFilter) {
            array_shift($this->filters);
        }

        if (empty($this->filters)) {
            return '';
        }

        $script = <<<'EOT'

		$("#filter-modal .submit").click(function () {
		    $("#filter-modal").modal('toggle');
		    $('body').removeClass('modal-open');
		    $('.modal-backdrop').remove();
		});
EOT;
        Gayly::script($script);

        return view($this->view)->with([
            'action'    => $this->action ?: $this->urlWithoutFilters(),
            'filters'   => $this->filters,
        ]);
	}

	protected function urlWithoutFilters()
    {
        $columns = [];

        /** @var Filter\AbstractFilter $filter * */
        foreach ($this->filters as $filter) {
            $columns[] = $filter->getColumn();
        }

        /** @var \Illuminate\Http\Request $request * */
        $request = Request::instance();

        $query = $request->query();
        array_forget($query, $columns);

        $question = $request->getBaseUrl().$request->getPathInfo() == '/' ? '/?' : '?';

        return count($request->query()) > 0
            ? $request->url() . $question . http_build_query($query)
            : $request->fullUrl();
    }

	public function __call($method, $arguments)
	{
		if (in_array($method, $this->supports)) {
			$className = '\\Onini\\Gayly\\Support\\Grid\\Filter\\' . ucfirst($method);
			// dump($className);
			return $this->addFilter(new $className(...$arguments));
		}

		return $this;
	}

	public function __toString()
	{
		return $this->render();
	}
}
