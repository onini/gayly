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

use Illuminate\Console\GeneratorCommand;

class InstallCommand extends GeneratorCommand
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
		parent::handle();
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

	protected function installGaylyBasePath()
	{

	}

	/**
     * Get the stub file for the generator.
     *
     * @return string
     */
	 protected function getStub($name = '')
	 {
		 return __DIR__.'/stubs/'.$name.'.stub';
	 }

}
