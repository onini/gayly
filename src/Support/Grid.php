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

namespace Onini\Gayly\Support;

use Closure;
use Onini\Gayly\Exception\Handler;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Onini\Gayly\Support\Grid\Model;
use Onini\Gayly\Support\Grid\Filter;
use Onini\Gayly\Support\Grid\Column;
use Onini\Gayly\Support\Grid\Row;
use Onini\Gayly\Support\Grid\Tool;
use Onini\Gayly\Support\Grid\Exporter;
use Onini\Gayly\Support\Grid\Tool\ExportButton;
use Onini\Gayly\Support\Grid\Displayers\Actions;
use Onini\Gayly\Support\Grid\Displayers\RowSelector;

class Grid
{
    protected $model;

    protected $columns;

    protected $dbColumns;

    protected $rows;

    protected $rowsCallback;

    protected $resource;

    protected $keyName = 'id';

    protected $builder;

    protected $builded = false;

    protected $variables = [];

    protected $filter;

    protected $exporter;

    protected $view = 'gayly::grid.table';

    protected $tool;

    public $perPages = [10, 20, 30, 50, 100];

    public $perPage = 20;

    protected $actionsCallback;

    protected $options = [
        'usePaginator'     => true,
        'useFilter'         => true,
        'useExporter'       => true,
        'useActions'        => true,
        'useRowSelector'    => true,
        'useCreate'       => true,
    ];

    public function __construct(Eloquent $model, Closure $builder)
    {
        $this->keyName = $model->getKeyName();
        $this->model = new Model($model);
        $this->keyName = $model->getKeyName();
        $this->columns = new Collection();
        $this->rows = new Collection();
        $this->builder = $builder;

        $this->setupTool();
        $this->setupFilter();
        $this->setupExporter();
    }

    protected function setupTool()
    {
        $this->tool = new Tool($this);
    }

    protected function setupFilter()
    {
        $this->filter = new Filter($this->model());
    }

    protected function setupExporter()
    {
        if ($scope = Input::get(Exporter::$queryName)) {
            $this->model()->usePaginate(false);

            call_user_func($this->builder, $this);

            (new Exporter($this))->resolve($this->exporter)->withScope($scope)->export();
        }
    }

    public function option($key, $value = null)
    {
        if (is_null($value)) {
            return $this->options[$key];
        }

        $this->options[$key] = $value;
        return $this;
    }

    public function model()
    {
        return $this->model;
    }

    public function disableFilter()
    {
        $this->option('useFilter', false);
        return $this;
    }

    protected function addColumn($column = '', $label = '')
    {
        $column = new Column($column, $label);
        $column->setGrid($this);
        return $this->columns[] = $column;
    }

    /**
     * Get the table columns for grid.
     *
     * @return void
     */
    protected function setDbColumns()
    {
        $connection = $this->model()->eloquent()->getConnectionName();
        $this->dbColumns = collect(Schema::connection($connection)->getColumnListing($this->model()->getTable()));
    }

    public function getKeyName()
    {
        return $this->keyName ?: 'id';
    }

    public function column($name, $label = '')
    {
        $relationName = $relationColumn = '';

        if (strpos($name, '.') !== false) {
            list($relationName, $relationColumn) = explode('.', $name);
            $relation = $this->model()->eloquent()->$relationName();
            $label = empty($label) ? ucfirst($relationColumn) : $label;
            $name = snake_case($relationName).'.'.$relationColumn;
        }

        $column = $this->addColumn($name, $label);

        if (isset($relation) && $relation instanceof Relation) {
            $this->model()->with($relationName);
            $column->setRelation($relationName, $relationColumn);
        }

        return $column;
    }

    public function columns($columns = [])
    {
        if (func_num_args() == 0) {
            return $this->columns;
        }

        if (func_num_args() == 1 && is_array($columns)) {
            foreach ($columns as $column => $label) {
                $this->column($column, $label);
            }
            return;
        }

        foreach (func_get_args() as $column) {
            $this->column($column);
        }
    }

    public function getFilter()
    {
        return $this->filter;
    }

    public function processFilter()
    {
        call_user_func($this->builder, $this);
        return $this->filter->execute();
    }

    public function filter(Closure $callback)
    {
        call_user_func($callback, $this->filter);
    }

    public function renderFilter()
    {
        if (!$this->option('useFilter')) {
            return '';
        }

        return $this->filter->render();
    }

    public function exportUrl($scope = 1, $args = null)
    {
        $input = array_merge(Input::all(), Exporter::formatExportQuery($scope, $args));
        return $this->resource().'?'.http_build_query($input);
    }

    public function useExport()
    {
        return $this->option('useExporter');
    }

    public function renderExportButton()
    {
        return new ExportButton($this);
    }

    public function removeCreate()
    {
        return $this->option('useCreate', false);
    }

    public function useCreate()
    {
        return $this->option('useCreate');
    }

    public function tool(Closure $callback)
    {
        return call_user_func($callback, $this->tool);
    }

    public function exporter($exporter)
    {
        $this->exporter = $exporter;

        return $this;
    }

    /**
     * render tool
     * @method renderHeaderTool
     * @return [type]           [description]
     */
    public function renderHeaderTool()
    {
        return $this->tool->render();
    }

    public function renderCreateButton()
    {
        return new \Onini\Gayly\Support\Grid\Tool\CreateButton($this);
    }

    public function resource($path = null)
    {
        if (!empty($path)) {
            $this->resource = $path;

            return $this;
        }

        if (!empty($this->resource)) {
            return $this->resource;
        }

        return app('request')->getPathInfo();
    }

    /**
     * set perpage
     * @method paginate
     * @param  integer  $perPage [description]
     * @return [type]            [description]
     */
    public function paginate($perPage = 20)
    {
        $this->perPage = $perPage;

        $this->model()->paginate($perPage);
    }

    public function paginator()
    {
        return new \Onini\Gayly\Support\Grid\Tool\Paginator($this);
    }

    public function removePaginator()
    {
        $this->option('usePaginator', false);

        return $this;
    }

    public function usePaginator()
    {
        return $this->option('usePaginator');
    }

    public function perPages(array $perPages)
    {
        $this->perPages = $perPages;
    }

    /**
         * Register column displayers.
         *
         * @return void.
         */
    public static function registerColumnDisplayer()
    {
        $map = [
                'editable'      => \Onini\Gayly\Support\Grid\Displayers\Editable::class,
                'switch'        => \Onini\Gayly\Support\Grid\Displayers\SwitchDisplay::class,
                'switchGroup'   => \Onini\Gayly\Support\Grid\Displayers\SwitchGroup::class,
                'select'        => \Onini\Gayly\Support\Grid\Displayers\Select::class,
                'image'         => \Onini\Gayly\Support\Grid\Displayers\Image::class,
                'label'         => \Onini\Gayly\Support\Grid\Displayers\Label::class,
                'button'        => \Onini\Gayly\Support\Grid\Displayers\Button::class,
                'link'          => \Onini\Gayly\Support\Grid\Displayers\Link::class,
                'badge'         => \Onini\Gayly\Support\Grid\Displayers\Badge::class,
                'progressBar'   => \Onini\Gayly\Support\Grid\Displayers\ProgressBar::class,
                'radio'         => \Onini\Gayly\Support\Grid\Displayers\Radio::class,
                'checkbox'      => \Onini\Gayly\Support\Grid\Displayers\Checkbox::class,
                'orderable'     => \Onini\Gayly\Support\Grid\Displayers\Orderable::class,
            ];

        foreach ($map as $abstract => $class) {
            Column::extend($abstract, $class);
        }
    }

    /**
     * Add variables to grid view.
     *
     * @param array $variables
     *
     * @return $this
     */
    public function with($variables = [])
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Get all variables will used in grid view.
     *
     * @return array
     */
    protected function variables()
    {
        $this->variables['grid'] = $this;

        return $this->variables;
    }

    /**
     * Set a view to render.
     *
     * @param string $view
     * @param array  $variables
     */
    public function setView($view, $variables = [])
    {
        if (!empty($variables)) {
            $this->with($variables);
        }

        $this->view = $view;
    }


    public function removeActions()
    {
        return $this->option('useActions', false);
    }

    public function actions(Closure $callback)
    {
        $this->actionsCallback = $callback;

        return $this;
    }

    protected function appendActionsColumn()
    {
        if (!$this->option('useActions')) {
            return;
        }

        $grid = $this;
        $callback = $this->actionsCallback;
        $column = $this->addColumn('__actions__', trans('gayly.action'));

        $column->display(function ($value) use ($grid, $column, $callback) {
            $actions = new Actions($value, $grid, $column, $this);

            return $actions->display($callback);
        });

        $column->setAttributes(['width' => '80']);
    }

    public function removeRowSelector()
    {
        $this->tool(function ($tool) {
            $tool->removeActionButton();
        });

        return $this->option('useRowSelector', false);
    }

    protected function prependRowSelectorColumn()
    {
        if (!$this->option('useRowSelector')) {
            return;
        }

        $grid = $this;

        $column = new Column(Column::SELECT_COLUMN_NAME, ' ');
        $column->setGrid($this)->display(function ($value) use ($grid, $column) {
            $actions = new RowSelector($value, $grid, $column, $this);

            return $actions->display();
        });

        $column->setAttributes(['width' => 40]);

        $this->columns->prepend($column);
    }

    public function build()
    {
        if ($this->builded) {
            return;
        }

        $data = $this->processFilter();

        $this->prependRowSelectorColumn();
        $this->appendActionsColumn();

        Column::setOriginalGridData($data);

        $this->columns->map(function (Column $column) use (&$data) {
            $data = $column->fill($data);

            $this->columnNames[] = $column->getName();
        });

        $this->buildRows($data);

        $this->builded = true;
    }

    protected function buildRows(array $data)
    {
        $this->rows = collect($data)->map(function ($model, $number) {
            return new Row($number, $model);
        });

        if ($this->rowsCallback) {
            $this->rows->map($this->rowsCallback);
        }
    }

    /**
     * Set grid row callback function.
     *
     * @param Closure $callable
     *
     * @return Collection|null
     */
    public function rows(Closure $callable = null)
    {
        if (is_null($callable)) {
            return $this->rows;
        }

        $this->rowsCallback = $callable;
    }

    public function render()
    {
        try {
            $this->build();
        } catch (\Exception $e) {
            return Handler::renderException($e);
        }

        return view($this->view, $this->variables())->render();
    }

    /**
     * Handle table column for grid.
     *
     * @param string $method
     * @param string $label
     *
     * @return bool|Column
     */
    protected function handleTableColumn($method, $label)
    {
        if (empty($this->dbColumns)) {
            $this->setDbColumns();
        }

        if ($this->dbColumns->has($method)) {
            return $this->addColumn($method, $label);
        }

        return false;
    }

    /**
     * Handle get mutator column for grid.
     *
     * @param string $method
     * @param string $label
     *
     * @return bool|Column
     */
    protected function handleGetMutatorColumn($method, $label)
    {
        if ($this->model()->eloquent()->hasGetMutator($method)) {
            return $this->addColumn($method, $label);
        }

        return false;
    }

    /**
     * Handle relation column for grid.
     *
     * @param string $method
     * @param string $label
     *
     * @return bool|Column
     */
    protected function handleRelationColumn($method, $label)
    {
        $model = $this->model()->eloquent();

        if (!method_exists($model, $method)) {
            return false;
        }

        if (!($relation = $model->$method()) instanceof Relation) {
            return false;
        }

        if ($relation instanceof HasOne || $relation instanceof BelongsTo) {
            $this->model()->with($method);

            return $this->addColumn($method, $label)->setRelation($method);
        }

        if ($relation instanceof HasMany || $relation instanceof BelongsToMany || $relation instanceof MorphToMany) {
            $this->model()->with($method);

            return $this->addColumn($method, $label);
        }

        return false;
    }

    public function __call($method, $arguments)
    {
        $label = isset($arguments[0]) ? $arguments[0] : ucfirst($method);
        //
        if ($column = $this->handleGetMutatorColumn($method, $label)) {
            return $column;
        }

        if ($column = $this->handleRelationColumn($method, $label)) {
            return $column;
        }

        if ($column = $this->handleTableColumn($method, $label)) {
            return $column;
        }

        // dump($method);
        return $this->addColumn($method, $label);
    }

    public function __toString()
    {
        return $this->render();
    }
}
