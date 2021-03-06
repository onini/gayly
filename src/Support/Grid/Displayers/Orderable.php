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

namespace Onini\Gayly\Support\Grid\Displayers;

use Gayly;

class Orderable extends AbstractDisplayer
{
    public function display()
    {
        if (!trait_exists('\Spatie\EloquentSortable\SortableTrait')) {
            throw new \Exception('To use orderable grid, please install package [spatie/eloquent-sortable] first.');
        }

        Gayly::script($this->script());

        return <<<EOT

<div class="btn-group">
    <button type="button" class="btn btn-xs btn-info grid-row-orderable" data-id="{$this->getKey()}" data-direction="1">
        <i class="fa fa-caret-up fa-fw"></i>
    </button>
    <button type="button" class="btn btn-xs btn-default grid-row-orderable" data-id="{$this->getKey()}" data-direction="0">
        <i class="fa fa-caret-down fa-fw"></i>
    </button>
</div>

EOT;
    }

    protected function script()
    {
        return <<<EOT

$('.grid-row-orderable').on('click', function() {

    var key = $(this).data('id');
    var direction = $(this).data('direction');

    $.post('{$this->getResource()}/' + key, {_method:'PUT', _token:LA.token, _orderable:direction}, function(data){
        if (data.status) {
            $.pjax.reload('#pjax-container');
            toastr.success(data.message);
        }
    });

});
EOT;
    }
}
