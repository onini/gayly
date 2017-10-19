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

namespace Onini\Gayly\Console;

use Illuminate\Routing\Console\ControllerMakeCommand as ControllerMake;

class ControllerMakeCommand extends ControllerMake
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'gayly:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';


    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $directory = config('gayly.directory');
        $namespace = ucfirst(basename($directory));
        return $rootNamespace . '\\' . $namespace . '\Controllers';
    }
}
