<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\DoctorInterface;

class DoctorController extends Controller
{
     protected $doctorRepository;

    public function __construct(DoctorInterface $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }
    public function allDoctors(Request $request)
    {
        return $this->doctorRepository->allDoctors($request);
    }
}
