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

class SwitchDisplay extends AbstractDisplayer
{
    protected $states = [
        'on'  => ['value' => 1, 'text' => 'ON', 'color' => 'primary'],
        'off' => ['value' => 0, 'text' => 'OFF', 'color' => 'default'],
    ];

    protected function updateStates($states)
    {
        foreach (array_dot($states) as $key => $state) {
            array_set($this->states, $key, $state);
        }
    }

    public function display($states = [], $js = null)
    {
        $this->updateStates($states);

        $name = $this->column->getName();

        $class = "grid-switch-{$name}";

        $js = $js ?? 'toastr.success(data.message);';

        $script = <<<EOT

$('.$class').bootstrapSwitch({
    size:'mini',
    onText: '{$this->states['on']['text']}',
    offText: '{$this->states['off']['text']}',
    onColor: '{$this->states['on']['color']}',
    offColor: '{$this->states['off']['color']}',
    onSwitchChange: function(event, state) {

        $(this).val(state ? 'on' : 'off');

        var pk = $(this).data('key');
        var value = $(this).val();

        $.ajax({
            url: "{$this->grid->resource()}/" + pk,
            type: "POST",
            data: {
                $name: value,
                _token: Gayly.token,
                _method: 'PUT'
            },
            success: function (data) {
                {$js}
            }
        });
    }
});

EOT;

        Gayly::script($script);

        $key = $this->row->{$this->grid->getKeyName()};

        $checked = $this->states['on']['value'] == $this->value ? 'checked' : '';

        return <<<EOT
        <input type="checkbox" class="$class" $checked data-key="$key" />
EOT;
    }
}
