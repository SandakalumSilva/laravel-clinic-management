<?php

namespace App\Providers;

use App\Interfaces\PatientInterface;
use App\Repositories\PatientRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
        $this->app->bind(PatientInterface::class,PatientRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
