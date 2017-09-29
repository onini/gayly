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

class InstallCommand extends Command
{
	/**
     * The console command name.
     *
     * @var string
     */
	protected $name = 'gayly:install';

	/**
     * The console command description.
     *
     * @var string
     */
	protected $description = 'Install gayly package';

	/**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
		$this->installPublishes();
    }

	/**
	 * Install public assets
	 * @method installPublishes
	 * @return [type]           [description]
	 */
	protected function installPublishes()
	{
		$this->call('vendor:publish', ['--provider' => \Onini\Gayly\GaylyServiceProvider::class]);
	}
}
