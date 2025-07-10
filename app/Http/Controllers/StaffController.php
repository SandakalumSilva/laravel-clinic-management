<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Interfaces\StaffInterface;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $staffRepository;

    public function __construct(StaffInterface $staffRepository){
        $this->staffRepository = $staffRepository;
    }

    public function allStaff(Request $request){
        return $this->staffRepository->allStaff($request);
    }
    public function saveStaff(StaffRequest $request){
        return $this->staffRepository->saveStaff($request);
    }
  
}
