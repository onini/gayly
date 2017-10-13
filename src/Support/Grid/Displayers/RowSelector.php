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

class RowSelector extends AbstractDisplayer
{
    public function display()
    {
        Gayly::script($this->script());

        return <<<EOT

<div class="checkbox check-success">
    <input id="gayly-checkbox-{$this->getKey()}" type="checkbox" value="1" class="gayly-checkbox" data-id="{$this->getKey()}">
    <label for="gayly-checkbox-{$this->getKey()}"></label>
</div>
EOT;
    }

    protected function script()
    {
        return <<<SCRIPT

        $('table .checkbox input').click( function() {
            if($(this).is(':checked')){
                $(this).parent().parent().parent().toggleClass('row_selected');
            } else {
                $(this).parent().parent().parent().toggleClass('row_selected');
            }
        });
SCRIPT;
    }
}
