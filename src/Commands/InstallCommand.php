<?php

namespace CozyFex\LaravelBoard\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cozyfex:board:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laravel Board with Login Username';

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
     * @return int
     */
    public function handle(): int
    {
        $this->call('migrate');

        $this->info('[CozyFex Board] was installed successfully!');

        return 0;
    }
}
