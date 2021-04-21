<?php

namespace App\Http\Controllers;

use App\UploadImage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use File;
use Illuminate\Support\Facades\DB;


class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(UploadImage::select('*'))
            // ->editColumn('image', function($data){
            //     return json_encode($data->image, true);
            // })
            ->addColumn('action', function($data){
                $action = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id='.$data->id.' data-original-title="Edit" class="edit btn btn-success edit-product">
                                Edit
                            </a>
                            <a href="javascript:void(0);" id="delete-product" data-toggle="tooltip" data-original-title="Delete" data-id='.$data->id.' class="delete btn btn-danger">
                                Delete
                            </a>';
                return $action;
                })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('uploadImage.image');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

        $uploadId = $request->upload_id;

        $details = ['id_card' => $request->id_card,
                    'nama' => $request->nama,
                    'description' => $request->description];

        if ($files = $request->file('image')) {

           //delete old file
           File::delete('images/profile/'.$request->hidden_image_update);

           //insert new file
           $destinationPath = 'images/profile/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $details['image'] = "$profileImage";
        }

        $product   =   UploadImage::updateOrCreate(['id' => $uploadId], $details);

        return response()->json($product);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $product  = UploadImage::where($where)->first();

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = UploadImage::where('id',$id)->first(['image']);
        \File::delete('images/profile/'.$data->image);
        $product = UploadImage::where('id',$id)->delete();

        return response()->json($product);
    }
}
