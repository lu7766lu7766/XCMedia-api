<?php

namespace Modules\Classified\Console;

use Illuminate\Console\Command;
use Modules\Classified\Collector\MediaCollector;

class GetMedia extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'media:get {media_type} {date?}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get media from skywalk api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $collector = app(MediaCollector::class);
        $collector->run($this->argument('media_type'), $this->argument('date'));
    }
}
