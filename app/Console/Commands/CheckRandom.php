<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Stream;

class CheckRandom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:random';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $stream = Stream::inRandomOrder()->first();
        echo "Checking {$stream->station->name}... ";
        if($stream->check()){
            $stream->works();
            echo "works \r\n";
        }else{
            $stream->reportError();
            echo "error \r\n";
        }
    }
}
