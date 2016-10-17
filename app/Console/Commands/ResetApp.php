<?php

namespace VotingApp\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ResetApp extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'votingapp:reset';

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
        if (! $this->confirm('Are you sure you want to delete all votes, users, and winners? [y|N]')) {
            return;
        }

        //remove non-admin users, password reminders, votes, and winners
        DB::table('votes')->delete();
        DB::table('users')->delete();
        DB::table('password_reminders')->delete();
        DB::table('winners')->delete();
    }
}
