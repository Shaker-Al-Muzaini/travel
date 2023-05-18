<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;



class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $r= Hotel::all();
        return $r;
    }

    public function index2()
    {
        $Hotels = Hotel::paginate(15);

        return view('dashboard.Hotel.index', compact('Hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Hotels=new Hotel();
        return view('dashboard.Hotel.create',compact(['Hotels']));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //        validate
        $clean_data=$request->validate(Hotel::rules($id=0),[
            'required'=>'يجب إدخال قيمه',
            'name.required'=>'يجب إدخال الاسم',
        ]);

//        $request->merge([
//            'slug'=>Str::slug($request->post('name'))
//        ]);
//        uplode images
        // تم تغير الى FILESYSTEM_DISK=public
        $date=$request->except('image');
        $date['image']=$this->uploadImage($request);
        $category=Hotel::create($date);
        return Redirect::route('hotel')
            ->with('success','Hotel Created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $Hotels=Hotel::findOrFail($id);
        } catch (\Exception $e){
            return Redirect::route('hotel')
                ->with('info','Record is  not  Fount !');

        }

        return view('dashboard.Hotel.edit',compact(['Hotels']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //        validate
        $request->validate(Hotel::rules());

        $Hotels=Hotel::findOrFail($id);
        $old_image=$Hotels->image;
        $date=$request->except('image');
        $new_image=$this->uploadImage($request);
        if ($new_image){
            $date['image']= $new_image;
        }
        $Hotels->update($date);
        if($old_image && $new_image){
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('hotel')
            ->with('success','Hotel Update !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Hotel::findOrFail($id);
        $category->delete();
//        if($category->image){
//            Storage::disk('public')->delete($category->image);
//        }
        return Redirect::route('hotel')
            ->with('wring','Hotel deleted !');
    }

    protected function uploadImage(Request $request)
    {
        if(!$request->hasFile('image')) {
            return;
        }
        $file= $request->file('image');
        $path='http://127.0.0.1:8000/storage/'.$file->store('uploads',[
                'disk'=>'public'
            ]);
        return $path;
    }
}

