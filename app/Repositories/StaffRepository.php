<?php

namespace App\Repositories;

use App\Interfaces\StaffInterface;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class StaffRepository implements StaffInterface
{
   public function allStaff($request)
{
    if ($request->ajax()) {
        $staff = User::select('users.*')
            ->orderBy('users.id', 'desc');

        return datatables()->of($staff)
            ->addIndexColumn() // for DT_RowIndex
            ->addColumn('actions', function ($row) {
                return '
                    <button class="btn btn-sm btn-primary view-staff" title="View" data-id="' . $row->id . '">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-warning edit-staff" title="Edit" data-id="' . $row->id . '">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-danger delete-staff" title="Delete" data-id="' . $row->id . '">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    return view('clinic.staff.staff');
}


    public function saveStaff($request){
        
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt(Str::random(8));
        $user->role = $request->role;
        if($request->specialization){
            $user->specialization = $request->specialization;
        }
        $user->save();

        return response()->json([
            'message' => 'Staff saved successfully.',
            'data' => $user
        ]);
    }
}
