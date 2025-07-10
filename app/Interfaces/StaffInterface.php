<?php 
namespace App\Interfaces;

interface StaffInterface{
    public function allStaff($request);
    public function saveStaff($request);
}