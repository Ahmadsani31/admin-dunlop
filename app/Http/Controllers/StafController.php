<?php

namespace App\Http\Controllers;

use App\Staf;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use FIle;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StafController extends Controller
{
    public function index(Request $request)
    {
        // $data = staf::get()->all();

        // dd($data);

        if ($request->ajax()) {
            $data = Staf::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                         $action = '<a href="javascript:void(0)" class="btn btn-success btn-sm editData"  data-toggle="tooltip" data-id='.$row->id.' data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <button type="button"  data-id="'.$row->id.'" class="btn btn-danger btn-sm deletestaf"><i class="fa fa-eraser"></i></button>';
                         return $action;
                         })
                    // ->addColumn('image', 'image')
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('staf.index');
    }


    public function store(Request $request)
    {
        // return response()->json($request);

        $rules = [
            'id_staf'       => 'required|unique:staf',
            'nama'          => 'required|min:3',
            'jabatan'       => 'required',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone'         => 'required|numeric|min:10',
        ];

        $messages = [
            'id_staf.unique'       => 'ID ini sudah terdaftar',
            'nama.min'             => 'Nama lengkap minimal 3 karakter',
            'phone.min'            => 'No Telepon Minimal 10 Angka',
            'phone.numeric'        => 'Gunakan Angka Untuk No Telphone',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $value = [
            'success' => false,
            'errors' => $validator->errors()
        ];

    //    if($validator->fails()){
    //        return response()->json($validator->getMessageBag()->toArray(), 400);
    //      }
       if($validator->fails()){
           return response()->json($value, 422);
       }


        $dataID = $request->id;
        $id_user = Auth::user()->id;

        $staf = [
            'user_id'       => $id_user,
            'id_staf'       => $request->id_staf,
            'jabatan'       => $request->jabatan,
            'nama'          => Str::title($request->nama),
            'email'         => $request->email,
            'phone'         => $request->phone,
            'alamat'        => Str::title($request->alamat),
        ];

        if ($files = $request->file('image')) {

            \File::delete('images/profile/'.$request->hidden_image_update);

            $destinationPath = public_path('images/profile/'); // upload path
            $profileImage = "profile"."-". date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $staf['image'] = $profileImage;

         }


         $data = Staf::updateOrCreate(['id' => $dataID], $staf);

        return response()->json(200);
    }


    public function edit($id)
    {
        $where = array('id' => $id);

        $item = Staf::where($where)->first();

        return response()->json($item);
    }

    public function update(Request $request)
    {
        $rules = [
            'nama'          => 'required|min:3',
            'jabatan'       => 'required',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone'         => 'required|numeric|min:10',
        ];

        $messages = [
            'nama.min'             => 'Nama lengkap minimal 3 karakter',
            'phone.min'            => 'No Telepon Minimal 10 Angka',
            'phone.numeric'        => 'Gunakan Angka Untuk No Telphone',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $value = [
            'success' => false,
            'errors' => $validator->errors()
        ];

    //    if($validator->fails()){
    //        return response()->json($validator->getMessageBag()->toArray(), 400);
    //      }
       if($validator->fails()){
           return response()->json($value, 422);
       }


        $dataID = $request->id;
        $id_user = Auth::user()->id;

        $staf = [
            'jabatan'       => $request->jabatan,
            'nama'          => Str::title($request->nama),
            'email'         => $request->email,
            'phone'         => $request->phone,
            'alamat'        => Str::title($request->alamat),
        ];

        if ($files = $request->file('image')) {

            \File::delete('images/profile/'.$request->hidden_image_update);

            $destinationPath = public_path('images/profile/'); // upload path
            $profileImage = "profile"."-". date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $staf['image'] = $profileImage;

         }


         $data = Staf::updateOrCreate(['id' => $dataID], $staf);

        return response()->json(200);
    }

    public function destroy($id)
    {
        $data = Staf::where('id',$id)->first(['image']);
        \File::delete('images/profile/'.$data->image);
        Staf::where('id',$id)->delete();
        return response()->json(['success'=>'Item deleted successfully.']);
    }
}
