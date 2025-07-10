<?php

namespace App\Providers;

use App\Interfaces\DepartmentInterface;
use App\Interfaces\PatientInterface;
use App\Interfaces\DoctorInterface;
use App\Interfaces\AppointmentInterface;
use App\Interfaces\StaffInterface;
use App\Models\Doctor;
use App\Repositories\DepartmentRepository;
use App\Repositories\PatientRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\AppointmentRepository; 
use App\Repositories\StaffRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(PatientInterface::class,PatientRepository::class);
        $this->app->bind(DepartmentInterface::class,DepartmentRepository::class);
        $this->app->bind(DoctorInterface::class,DoctorRepository::class);
        $this->app->bind(AppointmentInterface::class,AppointmentRepository::class);
        $this->app->bind(StaffInterface::class,StaffRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
