<?php namespace VotingApp\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use DB;

class ResetApp extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'reset:app';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Reset the app for a new year.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//remove non-admin users, password reminders, votes, and winners
		DB::table('votes')->delete();
		DB::table('users')->where('admin', '=', 0)->delete();
		DB::table('password_reminders')->delete();
		DB::table('winners')->delete();
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['example', InputArgument::OPTIONAL, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
