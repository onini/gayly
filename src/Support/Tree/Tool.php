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

namespace Onini\Gayly\Support\Tree;

use Onini\Gayly\Support\Tree;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;

class Tool implements Renderable
{
    /**
     * Parent tree.
     *
     * @var Tree
     */
    protected $tree;

    /**
     * Collection of tool.
     *
     * @var Collection
     */
    protected $tool;

    /**
     * Create a new Tool instance.
     *
     * @param Builder $builder
     */
    public function __construct(Tree $tree)
    {
        $this->tree = $tree;
        $this->tool = new Collection();
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
     * Render header tool bar.
     *
     * @return string
     */
    public function render()
    {
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
