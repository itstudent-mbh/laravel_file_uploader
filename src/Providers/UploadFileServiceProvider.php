<?php
namespace Mbhanife\UploadFile\Providers;

use Illuminate\Support\ServiceProvider;

class UploadFileServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}
