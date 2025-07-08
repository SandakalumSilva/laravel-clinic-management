<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
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

    public function saveDoctor(DoctorRequest $request)
    {
        return $this->doctorRepository->saveDoctor($request);
    }

    public function getDoctor($id)
    {
        return $this->doctorRepository->getDoctor($id);
    }
}
