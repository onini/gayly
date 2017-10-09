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

namespace Onini\Gayly\Support\Grid\Tool;

use Illuminate\Support\Collection;
use Gayly;

class ActionButton extends AbstractTool
{
    protected $action;

    protected $delete = true;

    public function __construct()
    {
        $this->action = new Collection();

        $this->appendDefaultAction();
    }

    protected function appendDefaultAction()
    {
        $this->add(trans('gayly.delete'), new DeleteAction());
    }

    public function removeDelete()
    {
        $this->delete = false;

        return $this;
    }

    public function add($title, AbstractAction $abstract)
    {
        $id = $this->action->count();

        $abstract->setId($id);

        $this->action->push(compact('id', 'title', 'abstract'));

        return $this;
    }

    protected function setUpScripts()
    {
        Gayly::script($this->script());

        foreach ($this->action as $action) {
            $abstract = $action['abstract'];
            $abstract->setResource($this->grid->resource());

            Gayly::script($abstract->script());
        }
    }


    protected function script()
    {
        return <<<EOT

		$('#gayly-check-all').on('click', function () {
			if ($(this).is(':checked')) {
                $('.gayly-checkbox').attr('checked', true);
				// $('.gayly-checkbox').trigger('click');
				$('.gayly-checkbox').parents('tr').addClass('row_selected');
			} else {
                $('.gayly-checkbox').attr('checked', false);
				// $('.gayly-checkbox').trigger('click');
				$('.gayly-checkbox').parents('tr').removeClass('row_selected');
			}
		});

		var selectedRows = function () {
		    var selected = [];
		    $('.gayly-checkbox:checked').each(function(){
		        selected.push($(this).data('id'));
		    });

		    return selected;
		}

EOT;
    }

    public function render()
    {
        if (!$this->delete) {
            $this->action->shift();
        }

        if ($this->action->isEmpty()) {
            return '';
        }

		$this->setUpScripts();

        return view('gayly::grid.action', ['action' => $this->action])->render();
    }
}
