<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all()->pluck('name','id');
        $user = User::all()->pluck('name','id');


        return view('setting.role',compact('role','user'));
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                         $action = '<button type="button"  data-id="'.$row->id.'" class="btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>';
                         return $action;
                         })
                    // ->addColumn('image', 'image')
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function store(Request $request)
    {
        // dd($request);
        request()->validate([
            'name' => 'required',
       ]);

       Role::create([
           'name'=> $request->name,
       ]);

       return redirect()->back();
    }

    public function setRoleUser(Request $request)
    {
        // dd($request);
        $user = User::findOrFail($request->id_user);
        $user->assignRole($request->role);

       return redirect()->back();

    }


}
