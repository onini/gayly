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

namespace Onini\Gayly\Support\Widgets;


use Illuminate\Contracts\Support\Renderable;

class Carousel extends Widget implements Renderable
{
    /**
     * @var string
     */
    protected $view = 'gayly::widgets.carousel';

    /**
     * @var array
     */
    protected $items;

    /**
     * @var string
     */
    protected $title = 'Carousel';

    /**
     * Carousel constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        $this->items = $items;

        $this->id('carousel-'.uniqid());
        $this->class('carousel slide');
        $this->offsetSet('data-ride', 'carousel');
    }

    /**
     * Set title.
     *
     * @param string $title
     */
    public function title($title)
    {
        $this->title = $title;
    }

    /**
     * Render Carousel.
     *
     * @return string
     */
    public function render()
    {
        $variables = [
            'items'         => $this->items,
            'title'         => $this->title,
            'attributes'    => $this->formatAttributes(),
        ];

        return view($this->view, $variables)->render();
    }
}
