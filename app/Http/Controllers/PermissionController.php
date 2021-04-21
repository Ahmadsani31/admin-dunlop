<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission as ContractsPermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        $role = Role::all()->pluck('name','id');

        $permission = Permission::all()->pluck('name','id');

        return view('setting.permission', compact('role','permission'));
    }


    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::latest()->get();
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

       Permission::create([
           'name'=> $request->name,
       ]);

       return redirect()->back();
    }

    public function roleSetPermission(Request $request)
    {
        // dd($request);
        $role = Role::findOrFail($request->role);


        foreach ($request->permission as $key => $value) {
            $pp = [
                'name' => $request->permission[$key],
            ];

            $role->givePermissionTo($pp);
        }

       return redirect()->back();

    }
}
