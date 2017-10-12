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
use Onini\Gayly\Support\Tree\Tool;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;

class Tree implements Renderable
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var string
     */
    protected $elementId = 'tree-';

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var \Closure
     */
    protected $queryCallback;

    /**
     * View of tree to render.
     *
     * @var string
     */
    protected $view = [
        'tree'      => 'gayly::tree',
        'branch'    => 'gayly::tree.branch',
    ];

    /**
     * @var \Closure
     */
    protected $callback;

    /**
     * @var null
     */
    protected $branchCallback = null;

    /**
     * @var bool
     */
    public $useCreate = true;

    public $useHeader = true;

    /**
     * @var array
     */
    protected $nestableOptions = [];

    /**
     * Header tool.
     *
     * @var Tool
     */
    public $tool;

    /**
     * Menu constructor.
     *
     * @param Model|null $model
     */
    public function __construct(Model $model = null, \Closure $callback = null)
    {
        $this->model = $model;

        $this->path = app('request')->getPathInfo();
        $this->elementId .= uniqid();

        $this->setupTool();

        if ($callback instanceof \Closure) {
            call_user_func($callback, $this);
        }

        $this->initBranchCallback();
    }

    /**
     * Setup tree tool.
     */
    public function setupTool()
    {
        $this->tool = new Tool($this);
    }

    /**
     * Initialize branch callback.
     *
     * @return void
     */
    protected function initBranchCallback()
    {
        if (is_null($this->branchCallback)) {
            $this->branchCallback = function ($branch) {
                $key = $branch[$this->model->getKeyName()];
                $title = $branch[$this->model->getTitleColumn()];

                return "$key - $title";
            };
        }
    }

    /**
     * Set branch callback.
     *
     * @param \Closure $branchCallback
     *
     * @return $this
     */
    public function branch(\Closure $branchCallback)
    {
        $this->branchCallback = $branchCallback;

        return $this;
    }

    /**
     * Set query callback this tree.
     *
     * @return Model
     */
    public function query(\Closure $callback)
    {
        $this->queryCallback = $callback;

        return $this;
    }

    /**
     * Set nestable options.
     *
     * @param array $options
     *
     * @return $this
     */
    public function nestable($options = [])
    {
        $this->nestableOptions = array_merge($this->nestableOptions, $options);

        return $this;
    }

    /**
     * Disable create.
     *
     * @return void
     */
    public function disableCreate()
    {
        $this->useCreate = false;
    }

    /**
     * Disable header.
     *
     * @return void
     */
    public function disableHeader()
    {
        $this->useHeader = false;
    }

    /**
     * Save tree order from a input.
     *
     * @param string $serialize
     *
     * @return bool
     */
    public function saveOrder($serialize)
    {
        $tree = json_decode($serialize, true);

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new \InvalidArgumentException(json_last_error_msg());
        }

        $this->model->saveOrder($tree);

        return true;
    }

    /**
     * Build tree grid scripts.
     *
     * @return string
     */
    protected function script()
    {
        $deleteConfirm = trans('gayly.delete_confirm');
        $saveSucceeded = trans('gayly.save_succeeded');
        $refreshSucceeded = trans('gayly.refresh_succeeded');
        $deleteSucceeded = trans('gayly.delete_succeeded');
        $confirm = trans('gayly.confirm');
        $cancel = trans('gayly.cancel');

        $nestableOptions = json_encode($this->nestableOptions);

        return <<<SCRIPT

        $('#{$this->elementId}').nestable($nestableOptions);

        $('.tree_branch_delete').click(function() {
            var id = $(this).data('id');
            swal({
                title: "$deleteConfirm",
			  	icon: "warning",
			  	buttons: ["$cancel", "$confirm"],
			  	dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'post',
                        url: '{$this->path}/' + id,
                        data: {
                            _method:'delete',
                            _token:Gayly.token,
                        },
                        success: function (data) {
                            if (typeof data === 'object') {
                                if (data.status) {
                                    swal(data.message, '', 'success')
                                    .then((value) => {
                                        location.reload();
                                    });
                                } else {
                                    swal(data.message, '', 'error');
                                }
                            }
                        }
                    })
                }
          });
        });
        toastr.options.onHidden = function() { location.reload(); }
        $('.{$this->elementId}-save').click(function () {
            var serialize = $('#{$this->elementId}').nestable('serialize');

            $.post('{$this->path}', {
                _token: Gayly.token,
                _order: JSON.stringify(serialize)
            },
            function(data){
                toastr.success('{$saveSucceeded}');
            });
        });

        $('.{$this->elementId}-refresh').click(function () {
            location.reload();
            // toastr.success('{$refreshSucceeded}');
        });

        $('.{$this->elementId}-tree-tool').on('click', function(e){
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse') {
                $('.dd').nestable('collapseAll');
            }
        });


SCRIPT;
    }

    /**
     * Set view of tree.
     *
     * @param string $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * Return all items of the tree.
     *
     * @param array $items
     */
    public function getItems()
    {
        return $this->model->withQuery($this->queryCallback)->toTree();
    }

    /**
     * Variables in tree template.
     *
     * @return array
     */
    public function variables()
    {
        return [
            'id'        => $this->elementId,
            'tool'     => $this->tool->render(),
            'items'     => $this->getItems(),
            'useCreate' => $this->useCreate,
            'useHeader' => $this->useHeader,
        ];
    }

    /**
     * Setup grid tool.
     *
     * @param Closure $callback
     *
     * @return void
     */
    public function tool(Closure $callback)
    {
        call_user_func($callback, $this->tool);
    }

    /**
     * Render a tree.
     *
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function render()
    {
        Gayly::script($this->script());

        view()->share([
            'path'           => $this->path,
            'keyName'        => $this->model->getKeyName(),
            'branchView'     => $this->view['branch'],
            'branchCallback' => $this->branchCallback,
        ]);

        return view($this->view['tree'], $this->variables())->render();
    }

    /**
     * Get the string contents of the grid view.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
