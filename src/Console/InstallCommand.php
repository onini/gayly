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

use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Onini\Gayly\Models\SystemUser;

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
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Onini\Gayly';

	protected $directory = '';

	protected $controller = '';

	public function __construct(Filesystem $files)
	{
		parent::__construct($files);

		$this->directory = config('gayly.directory', 'Gayly');
		$this->controller = $this->directory.'/Controllers';
	}

	/**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

		if (!file_exists(config_path('gayly.php'))) {
			$this->error('Please run `vendor:publish`');
			exit;
		}

		$this->installMigrateAndSeeder();
		$this->installGaylyController();
		$this->installRoutesFile();

		$this->info($this->type.' install successfully.');
    }

	/**
	 * [installMigrateAndSeeder description]
	 * @method installMigrateAndSeeder
	 * @return [type]                  [description]
	 */
	protected function installMigrateAndSeeder()
	{
		$this->call('migrate');
		$this->call('db:seed', ['--class' => \Onini\Gayly\Seeder\GaylyTableSeeder::class]);
	}

	/**
	 * Install Gayly base path
	 * @method installGaylyController
	 * @return [type]                 [description]
	 */
	protected function installGaylyController()
	{
		$name = $this->qualifyClass($this->controller.'/DashController');
		$path = $this->getPath($name);

		$this->makeDirectory($path);

		$this->files->put($path, $this->buildClass($name));
		$this->info('DashController created successfully.');
	}

	/**
	 * Install routes
	 * @method installRoutesFile
	 * @return [type]            [description]
	 */
	protected function installRoutesFile()
	{
		$routes = $this->files->get($this->getStub('routes'));
		$path = $this->getPath($this->directory.'/routes');

		$this->files->put($path, $routes);
		$this->info('routes created successfully.');
	}

	/**
	 * Build the class with the given name.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function buildClass($name)
	{
		$stub = $this->files->get($this->getStub('controller'));

		return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
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

	 /**
	  * Get the console command arguments.
	  *
	  * @return array
	  */
	 protected function getArguments()
	 {
		 return [
		 ];
	 }
}
