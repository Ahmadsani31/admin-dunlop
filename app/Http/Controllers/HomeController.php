<?php

namespace App\Http\Controllers;

use App\DetailBan;
use Illuminate\Http\Request;
use App\Staf;
use App\Loan;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $staf = Staf::all();
        // $loan = DetailBan::all();

        // $user = User::find(2);
// dd($user->permissions);

        // auth()->user()->permissions
        // dd(auth()->user()->hasRole('operator'));

        // return auth()->user()->hasRole('admin');
        // $per = Permission::create(['name'=>'update post']);

        // $user = User::findOrFail($request->id_user);

        // $user->assignRole('admin');


        //untuk set Role memiliki permission apa saja
        // $role = Role::findOrFail($request->role);
        // $role->givePermissionTo(['create','read']);

        // $user = User::find(3);
        // $user->assignRole('admin');


        return view('home', compact('staf'));
    }
}
