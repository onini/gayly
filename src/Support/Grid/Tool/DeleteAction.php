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

class DeleteAction extends AbstractAction
{

	public function script()
	{
		$deleteConfirm = trans('gayly.delete_confirm');
        $confirm = trans('gayly.confirm');
        $cancel = trans('gayly.cancel');

		return <<<SCRIPT

		$('{$this->getElementClass()}').on('click', function() {

		    var id = selectedRows().join();

			if (!id.length) {
				swal({
					title: '请选择要删除的数据',
					icon: 'error'
				});
				return;
			}

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
			            url: '{$this->resource}/' + id,
			            data: {
			                _method:'delete',
			                _token:Gayly.token,
			            },
			            success: function (data) {
			                console.log(data);
			            }
					})
			  	}
			});
		});

SCRIPT;
	}
}
