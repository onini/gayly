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

class RefreshButton extends AbstractTool
{

	public function render()
	{
		$refresh = trans('gayly.refresh');
		return <<<HTML
			<button type="button" class="btn btn-info btn-xs btn-mini"><i class="fa fa-refresh"></i> {$refresh}</button>
HTML;
	}
}
