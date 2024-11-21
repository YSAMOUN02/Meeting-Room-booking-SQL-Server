<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ViteBuild extends Command
{
    protected $signature = 'vite:build';
    protected $description = 'Run Vite build process';

    public function handle()
    {
        $this->info('Running Vite build...');
        passthru('npm run build');
        $this->info('Vite build completed!');
    }
}

