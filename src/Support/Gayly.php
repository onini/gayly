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

namespace Onini\Gayly\Support;

use Auth;
use Closure;
use Onini\Gayly\Support\Layout\Content;
use Onini\Gayly\Models\Menu;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Gayly
{
    /**
     * [public description]
     * @var [type]
     */
    public static $css = [];

    /**
     * [public description]
     * @var [type]
     */
    public static $js = [];

    /**
     * [public description]
     * @var [type]
     */
    public static $script = [];

    /**
     * [protected description]
     * @var [type]
     */
    protected static $extension = [];

    /**
     * [content description]
     * @method content
     * @param  [type]  $callable [description]
     * @return [type]            [description]
     */
    public function content(Closure $callable = null)
    {
        return new Content($callable);
    }

    /**
     * [grid description]
     * @method grid
     * @param  [type]  $model    [description]
     * @param  Closure $callable [description]
     * @return [type]            [description]
     */
    public function grid($model, Closure $callable)
    {
        return new Grid($this->getModel($model), $callable);
    }

    /**
     * [form description]
     * @method form
     * @param  [type]  $model    [description]
     * @param  Closure $callable [description]
     * @return [type]            [description]
     */
    public function form($model, Closure $callable)
    {
        return new Form($this->getModel($model), $callable);
    }

    /**
     * [tree description]
     * @method tree
     * @param  [type] $model    [description]
     * @param  [type] $callable [description]
     * @return [type]           [description]
     */
    public function tree($model, Closure $callable = null)
    {
        return new Tree($this->getModel($model), $callable);
    }

    /**
     * [user description]
     * @method user
     * @return [type] [description]
     */
    public function user()
    {
        return Auth::guard('gayly')->user();
    }

    /**
     * [title description]
     * @method title
     * @return [type] [description]
     */
    public function title()
    {
        return config('gayly.title');
    }

    /**
     * [menu description]
     * @method menu
     * @return [type] [description]
     */
    public function menu()
    {
        return (new Menu())->toTree();
    }

    /**
     * [getModel description]
     * @method getModel
     * @param  [type]   $model [description]
     * @return [type]          [description]
     */
    public function getModel($model)
    {
        if ($model instanceof EloquentModel) {
            return $model;
        }

        if (is_string($model) && class_exists($model)) {
            return $this->getModel(new $model());
        }

        throw new InvalidArgumentException("$model is not a valid model");
    }

    /**
     * [css description]
     * @method css
     * @param  [type] $css [description]
     * @return [type]      [description]
     */
    public static function css($css = null)
    {
        if (!is_null($css)) {
            self::$css = array_merge(self::$css, (array) $css);

            return;
        }

        $css = array_get(Form::collectFieldAssets(), 'css', []);

        static::$css = array_merge(static::$css, (array) $css);
        return view('gayly::partials.css', ['css' => array_unique(static::$css)]);
    }

    /**
     * [js description]
     * @method js
     * @param  [type] $js [description]
     * @return [type]     [description]
     */
    public static function js($js = null)
    {
        if (!is_null($js)) {
            self::$js = array_merge(self::$js, (array) $js);

            return;
        }

        $js = array_get(Form::collectFieldAssets(), 'js', []);

        static::$js = array_merge(static::$js, (array) $js);
        return view('gayly::partials.js', ['js' => array_unique(static::$js)]);
    }

    /**
     * [script description]
     * @method script
     * @param  string $script [description]
     * @return [type]         [description]
     */
    public static function script($script = '')
    {
        if (!empty($script)) {
            self::$script = array_merge(self::$script, (array) $script);

            return;
        }

        return view('gayly::partials.script', ['script' => array_unique(self::$script)]);
    }

    /**
     * [extension description]
     * @method extension
     * @param  [type]    $key   [description]
     * @param  [type]    $class [description]
     * @return [type]           [description]
     */
    public static function extension($key, $class)
    {
        static::$extension[$key] = $class;
    }
}
