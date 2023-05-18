<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Propertie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;



class propertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $r= Propertie::all();
        return $r;
    }

    public function index2()
    {
        $properties = Propertie::paginate(15);

        return view('dashboard.Properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $properties=new Propertie();
        return view('dashboard.Properties.create',compact(['properties']));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $clean_data = $request->validate(Propertie::rules($id = 0), [
            'required' => 'يجب إدخال قيمة',
            'title.required' => 'يجب إدخال الاسم',
        ]);

        // upload featured image
        $featured_image = $this->uploadImage($request, 'featured_image');

        // upload gallery images
        $gallery_images = $this->uploadImages($request, 'gallery');

        // create property
        $data = $request->except('featured_image', 'gallery');
        $data['featured_image'] = $featured_image;
        $data['gallery'] = $gallery_images;
        $propertie = Propertie::create($data);

        return Redirect::route('propertie')->with('success', 'The properties were created successfully!');
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
            $properties=Propertie::findOrFail($id);
        } catch (\Exception $e){
            return Redirect::route('propertie')
                ->with('info','Record is  not  Fount !');

        }

        return view('dashboard.Properties.edit',compact(['properties']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $request->validate(Propertie::rules());

        $property = Propertie::findOrFail($id);

        $old_featured_image = $property->featured_image;
        $new_featured_image = $this->uploadImage($request, 'featured_image');

        if ($new_featured_image) {
            $property->featured_image = $new_featured_image;
        }

        $data = $request->except('featured_image');

        $property->update($data);

        if ($old_featured_image && $new_featured_image && $old_featured_image !== $new_featured_image) {
            Storage::disk('public')->delete($old_featured_image);
        }

        return Redirect::route('propertie')->with('success', 'Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Propertie::findOrFail($id);
        $category->delete();
//        if($category->image){
//            Storage::disk('public')->delete($category->image);
//        }
        return Redirect::route('propertie')
            ->with('wring','Properties deleted !');
    }

    protected function uploadImage(Request $request, $fieldName)
    {
        if (!$request->hasFile($fieldName)) {
            return;
        }

        $image = $request->file($fieldName);
        $path = 'http://127.0.0.1:8000/storage/' . $image->store('uploads', [
                'disk' => 'public',
            ]);

        return $path;
    }

    protected function uploadImages(Request $request, $fieldName)
    {
        if (!$request->hasFile($fieldName)) {
            return [];
        }

        $images = $request->file($fieldName);
        $paths = [];

        foreach ($images as $image) {
            $path = 'http://127.0.0.1:8000/storage/' . $image->store('uploads', [
                    'disk' => 'public',
                ]);

            $paths[] = $path;
        }

        return implode(',', $paths); // تحويل المصفوفة إلى سلسلة نصية مفصولة بفاصلة
    }

}





