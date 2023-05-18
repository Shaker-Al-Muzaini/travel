<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Hotel;
use App\Models\Propertie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $r= Propertie::all();
//        return $r;
    }

    public function index2()
    {
        $articles = Article::paginate(15);

        return view('dashboard.Articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $articles=new Propertie();
        return view('dashboard.Articles.create',compact(['articles']));

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
        $featured_image = $this->uploadImage($request, 'head_image');

        // upload gallery images
        $gallery_images = $this->uploadImage($request, 'featured_image');

        // create property
        $data = $request->except('head_image', 'featured_image');
        $data['head_image'] = $featured_image;
        $data['featured_image'] = $gallery_images;
        $propertie = Article::create($data);

        return Redirect::route('articles')->with('success', 'The articles were created successfully!');
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
            $articles=Article::findOrFail($id);
        } catch (\Exception $e){
            return Redirect::route('articles')
                ->with('info','Record is  not  Fount !');

        }

        return view('dashboard.Articles.edit',compact(['articles']));
    }

    public function update(Request $request, string $id)
    {
        // validate
        $request->validate(Article::rules());

        $articles = Article::findOrFail($id);

        $old_featured_image = $articles->head_image;
        $new_featured_image = $this->uploadImage($request, 'head_image');
        $old_featured_image2 = $articles->featured_image;
        $new_featured_image2 = $this->uploadImage($request, 'featured_image');

        if ($new_featured_image) {
            $articles->featured_image = $new_featured_image;
        }
        if ($new_featured_image2) {
            $articles->featured_image = $new_featured_image2;
        }

        $data = $request->except('featured_image','head_image');

        $articles->update($data);

//        if ($old_featured_image && $new_featured_image && $old_featured_image !== $new_featured_image) {
//            Storage::disk('public')->delete($old_featured_image);
//        }

        return Redirect::route('articles')->with('success', 'Updated Successfully!!');
    }

    public function destroy(string $id)
    {
        $category=Article::findOrFail($id);
        $category->delete();
//        if($category->image){
//            Storage::disk('public')->delete($category->image);
//        }
        return Redirect::route('articles')
            ->with('wring','articles deleted !');
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



}

