<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:system-info')]
#[Description('Command description')]
class SystemInfo extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
