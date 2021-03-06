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

class Select extends AbstractDisplayer
{
    public function display($options = [])
    {
        $name = $this->column->getName();

        $class = "grid-select-{$name}";

        $script = <<<EOT

$('.$class').select2().on('change', function(){

    var pk = $(this).data('key');
    var value = $(this).val();

    $.ajax({
        url: "{$this->grid->resource()}/" + pk,
        type: "POST",
        data: {
            $name: value,
            _token: LA.token,
            _method: 'PUT'
        },
        success: function (data) {
            toastr.success(data.message);
        }
    });
});

EOT;

        Gayly::script($script);

        $key = $this->row->{$this->grid->getKeyName()};

        $optionsHtml = '';

        foreach ($options as $option => $text) {
            $selected = $option == $this->value ? 'selected' : '';
            $optionsHtml .= "<option value=\"$option\" $selected>$text</option>";
        }

        return <<<EOT
<select style="width: 100%;" class="$class btn btn-mini" data-key="$key">
$optionsHtml
</select>

EOT;
    }
}
