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

namespace Onini\Gayly\Support\Form;

use Onini\Gayly\Support\Facades\Gayly;
use Onini\Gayly\Support\Form;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Tool implements Renderable
{
    /**
     * @var Builder
     */
    protected $form;

    /**
     * Collection of tool.
     *
     * @var Collection
     */
    protected $tool;

    /**
     * @var array
     */
    protected $options = [
        'enableListButton' => true,
        'enableBackButton' => true,
    ];

    /**
     * Create a new Tool instance.
     *
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->form = $builder;

        $this->tool = new Collection();
    }

    /**
     * @return string
     */
    protected function backButton()
    {
        $script = <<<'EOT'
$('.form-history-back').on('click', function (event) {
    event.preventDefault();
    history.back(1);
});
EOT;

        Gayly::script($script);

        $text = trans('gayly.back');

        return <<<EOT
<div class="btn-group pull-right" style="margin-right: 10px">
    <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;$text</a>
</div>
EOT;
    }

    public function listButton()
    {
        $slice = Str::contains($this->form->getResource(0), '/edit') ? null : -1;
        $resource = $this->form->getResource($slice);

        $text = trans('gayly.list');

        return <<<EOT
<div class="btn-group pull-right" style="margin-right: 10px">
    <a href="$resource" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;$text</a>
</div>
EOT;
    }

    /**
     * Prepend a tool.
     *
     * @param string $tool
     *
     * @return $this
     */
    public function add($tool)
    {
        $this->tool->push($tool);

        return $this;
    }

    /**
     * Disable back button.
     *
     * @return $this
     */
    public function disableBackButton()
    {
        $this->options['enableBackButton'] = false;

        return $this;
    }

    /**
     * Disable list button.
     *
     * @return $this
     */
    public function disableListButton()
    {
        $this->options['enableListButton'] = false;

        return $this;
    }

    /**
     * Render header tool bar.
     *
     * @return string
     */
    public function render()
    {
        if ($this->options['enableListButton']) {
            $this->add($this->listButton());
        }

        if ($this->options['enableBackButton']) {
            $this->add($this->backButton());
        }

        return $this->tool->map(function ($tool) {
            if ($tool instanceof Renderable) {
                return $tool->render();
            }

            if ($tool instanceof Htmlable) {
                return $tool->toHtml();
            }

            return (string) $tool;
        })->implode(' ');
    }
}
