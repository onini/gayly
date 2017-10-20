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

use Illuminate\Console\Command;
use Onini\Gayly\Support\Gayly;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gayly:import {extension?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import extension';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $extension = $this->argument('extension');

        if (empty($extension) || !array_has(Gayly::$extensions, $extension)) {
            $extension = $this->choice('Please choose a extension to import', array_keys(Gayly::$extensions));
        }

        $className = array_get(Gayly::$extensions, $extension);

        if (!class_exists($className) || !method_exists($className, 'install')) {
            $this->error("Invalid Extension [$className]");

            return;
        }

        call_user_func([$className, 'install'], $this);

        $this->info("Extension [$className] imported");
    }
}
