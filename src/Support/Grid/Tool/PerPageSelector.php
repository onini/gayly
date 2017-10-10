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
use Onini\Gayly\Support\Grid;

class PerPageSelector extends AbstractTool
{
    protected $perPage;

    protected $perPageName = '';

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;

        $this->initialize();
    }

    protected function initialize()
    {
        $this->perPageName = $this->grid->model()->getPerPageName();

        $this->perPage = (int) app('request')->input(
            $this->perPageName,
            $this->grid->perPage
        );
    }

    public function getOptions()
    {
        return collect($this->grid->perPages)
        ->push($this->grid->perPage)
        ->push($this->perPage)
        ->unique()
        ->sort();
    }

    /**
     * Render PerPageSelector。
     *
     * @return string
     */
    public function render()
    {
        Gayly::script($this->script());

        $options = $this->getOptions()->map(function ($option) {
            $selected = ($option == $this->perPage) ? 'selected' : '';
            $url = app('request')->fullUrlWithQuery([$this->perPageName => $option]);

            return "<option value=\"$url\" $selected>$option</option>";
        })->implode("\r\n");

        $show = trans('gayly.show');
        $entries = trans('gayly.entries');

        return <<<EOT

<label class="control-label pull-right" style="margin-right: 10px; font-weight: 100;">

        <select class="input-sm gayly-perpage form-control" name="per-page">
            $options
        </select>
    </label>

EOT;
    }

    /**
     * Script of PerPageSelector.
     *
     * @return string
     */
    protected function script()
    {
        return <<<'EOT'

$('.gayly-perpage').on("change", function(e) {
    
});

EOT;
    }
}
