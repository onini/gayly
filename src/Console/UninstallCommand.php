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

class UninstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'gayly:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall Onini\Gayly Package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirm('Are you sure to uninstall Onini\\Gayly package?')) {
            return;
        }

        $this->removeFilesAndDirectory();

        $this->info('Onini\\Gayly was uninstalled!');
    }

    /**
     * remove files and directory
     * @method removeFilesAndDirectory
     * @return [type]                  [description]
     */
    protected function removeFilesAndDirectory()
    {
        $this->laravel['files']->deleteDirectory(config('gayly.directory'));
        $this->laravel['files']->deleteDirectory(public_path('vendor/gayly'));
        $this->laravel['files']->delete(config_path('gayly.php'));
        $this->laravel['files']->delete(database_path('migrations/2017_09_29_094348_create_gayly_table.php'));
    }
}
