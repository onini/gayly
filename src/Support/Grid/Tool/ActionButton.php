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

	public function render()
	{
		if (!$this->delete) {
			$this->action->shift();
		}

		if ($this->action->isEmpty()) {
			return '';
		}

		return view('gayly::grid.action', ['action' => $this->action])->render();
	}
}
