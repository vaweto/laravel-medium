<?php

namespace Vaweto\Medium\Commands;

use Illuminate\Console\Command;

class MediumCommand extends Command
{
    public $signature = 'laravel-medium';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
