<?php

namespace App\Providers;

use App\Interfaces\DepartmentInterface;
use App\Interfaces\PatientInterface;
use App\Interfaces\DoctorInterface;
use App\Models\Doctor;
use App\Repositories\DepartmentRepository;
use App\Repositories\PatientRepository;
use App\Repositories\DoctorRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(PatientInterface::class,PatientRepository::class);
        $this->app->bind(DepartmentInterface::class,DepartmentRepository::class);
        $this->app->bind(DoctorInterface::class,DoctorRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
