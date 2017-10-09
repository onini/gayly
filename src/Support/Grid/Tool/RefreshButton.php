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

use Gayly;

class RefreshButton extends AbstractTool
{

	protected function script()
	{
		return <<<SCRIPT

		$('.gayly-refresh').click(function () {
			location.reload();
		});
SCRIPT;
	}

	public function render()
	{
		Gayly::script($this->script());

		$refresh = trans('gayly.refresh');
		return <<<HTML
			<div class="pull-left">
				<button type="button" class="btn btn-info btn-xs btn-mini m-l-10 gayly-refresh"><i class="fa fa-refresh"></i> {$refresh}</button>
			</div>
HTML;
	}
}
