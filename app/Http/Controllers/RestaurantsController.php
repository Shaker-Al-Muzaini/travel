<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;



class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $r= Restaurant::all();
        return $r;
    }

    public function index2()
    {
        $restaurants = Restaurant::paginate(15);

        return view('dashboard.Restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants=new Restaurant();
        return view('dashboard.Restaurants.create',compact(['restaurants']));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $clean_data = $request->validate(Restaurant::rules($id = 0), [
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
        $restaurants = Restaurant::create($data);

        return Redirect::route('restaurants')->with('success', 'The restaurants were created successfully!');
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
            $restaurants=Restaurant::findOrFail($id);
        } catch (\Exception $e){
            return Redirect::route('Restaurant')
                ->with('info','Record is  not  Fount !');

        }

        return view('dashboard.Restaurants.edit',compact(['restaurants']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $request->validate(Restaurant::rules());

        $property = Restaurant::findOrFail($id);

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

        return Redirect::route('restaurants')->with('success', 'Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Restaurant::findOrFail($id);
        $category->delete();
//        if($category->image){
//            Storage::disk('public')->delete($category->image);
//        }
        return Redirect::route('restaurants')
            ->with('wring','restaurants deleted !');
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
