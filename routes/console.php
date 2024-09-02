<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('remove:controller {name : Name of the controller}', function ($name) {

    // File location
    $file_location = base_path() . '/app/Http/Controllers/' . $name . '.php';

    // Check if exist
    if (file_exists($file_location)) {
        exec('rm ' . $file_location);
        $this->info($name.' has been deleted!');
    } else {
        $this->error('Cannot delete ' . $name . ', file not found.');
    }

})->describe('Remove spesific controller');
