<?php

namespace Onini\Gayly\Support\Grid\Displayers;

use Gayly;

class Actions extends AbstractDisplayer
{
    /**
     * @var array
     */
    protected $appends = [];

    /**
     * @var array
     */
    protected $prepends = [];

    /**
     * @var bool
     */
    protected $allowEdit = true;

    /**
     * @var bool
     */
    protected $allowDelete = true;

    /**
     * @var string
     */
    protected $resource;

    /**
     * @var
     */
    protected $key;

    /**
     * Append a action.
     *
     * @param $action
     *
     * @return $this
     */
    public function append($action)
    {
        array_push($this->appends, $action);

        return $this;
    }

    /**
     * Prepend a action.
     *
     * @param $action
     *
     * @return $this
     */
    public function prepend($action)
    {
        array_unshift($this->prepends, $action);

        return $this;
    }

    /**
     * Disable delete.
     *
     * @return void.
     */
    public function removeDelete()
    {
        $this->allowDelete = false;
    }

    /**
     * Disable edit.
     *
     * @return void.
     */
    public function removeEdit()
    {
        $this->allowEdit = false;
    }

    /**
     * Set resource of current resource.
     *
     * @param $resource
     *
     * @return void
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Get resource of current resource.
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource ?: parent::getResource();
    }

    /**
     * {@inheritdoc}
     */
    public function display($callback = null)
    {
        if ($callback instanceof \Closure) {
            $callback->call($this, $this);
        }

        $actions = $this->prepends;
        if ($this->allowEdit) {
            array_push($actions, $this->editAction());
        }

        if ($this->allowDelete) {
            array_push($actions, $this->deleteAction());
        }

        $actions = array_merge($actions, $this->appends);

        return implode('', $actions);
    }

    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    public function getKey()
    {
        if ($this->key) {
            return $this->key;
        }

        return parent::getKey();
    }

    /**
     * Built edit action.
     *
     * @return string
     */
    protected function editAction()
    {
        return <<<EOT

<a href="{$this->getResource()}/{$this->getKey()}/edit" class="label label-success">
    <i class="fa fa-edit" style="margin-right: -4px"></i>
</a>
EOT;
    }

    /**
     * Built delete action.
     *
     * @return string
     */
    protected function deleteAction()
    {
        $deleteConfirm = trans('gayly.delete_confirm');
        $confirm = trans('gayly.confirm');
        $cancel = trans('gayly.cancel');

        $script = <<<SCRIPT

        $('.grid-row-delete').unbind('click').click(function() {

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
			            url: '{$this->getResource()}/' + id,
			            data: {
			                _method:'delete',
			                _token:Gayly.token,
			            },
			            success: function (data) {
                            if (typeof data === 'object') {
                                const type = data.status ? 'success' : 'error' ;
                                swal(data.message, '', type)
                                .then((value) => {
                                    location.reload();
                                });
                            }
			            }
					})
			  	}
			});
        });

SCRIPT;

        Gayly::script($script);

        return <<<EOT

<a href="javascript:void(0);" data-id="{$this->getKey()}" class="grid-row-delete label label-danger m-l-5">
    <i class="fa fa-trash"></i>
</a>

EOT;
    }
}
