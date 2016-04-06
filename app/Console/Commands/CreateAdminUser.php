<?php

namespace VotingApp\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use VotingApp\Models\User;

class CreateAdminUser extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'user:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new administrator for this instance of the voting app.';

    /**
     * Create a new command instance.
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
        $user = User::create([
            'northstar_id' => $this->argument('id'),
        ]);

        $user->admin = true;
        $user->save();

        $this->info('Created new administrator!');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['id', InputArgument::REQUIRED, 'The administrator\'s Northstar ID.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
