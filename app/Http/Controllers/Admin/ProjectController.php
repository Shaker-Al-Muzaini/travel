<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return response()->json(['projects' => $projects], 200);
    }
    public function index2()
    {
        $Projects = Project::all();
        return view('dashboard.projects.index', compact('Projects'));
    }

    public  function  create(){
        $projects=new Project();
        return view('dashboard.projects.create',compact(['projects']));
    }
    public function th_project()
    {
        $r= Project::limit(3)->get();
        return $r;
    }


    public function store(Request $request)
    {

        //        validate
        $clean_data=$request->validate(Project::rules($id=0),[
            'required'=>'يجب إدخال قيمه',
            'name.required'=>'يجب إدخال الاسم',
        ]);

        $date=$request->except(['project_image_1']);
        $date['project_image_1']=$this->uploadImage($request);
        $Project=Project::create($date);
        return Redirect::route('project')
            ->with('success','projects Created !');
    }


    public function show(string $id)
    {
        try {
            $project = Project::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'project' => $project
                ],
                'message' => trans('messages.show_success', ['name' => 'المشروع'])
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => trans('messages.not_found', ['name' => 'المشروع'])
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => trans('messages.error', ['action' => 'عرض', 'name' => 'المشروع'])
            ], 500);
        }
}

    public function edit($id){
        try {
            $projects=Project::findOrFail($id);
        } catch (\Exception $e){
            return Redirect::route('Project')
                ->with('info','Record is  not  Fount !');

        }
        return view('dashboard.projects.edit',compact(['projects']));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,Project $project)
    {
        $request->validate(Project::rules());

        $Projects=Project::findOrFail($id);
        $old_image=$Projects->project_image_1;
        $date=$request->except('project_image_1');
        $new_image=$this->uploadImage($request);
        if ($new_image){
            $date['project_image_1']= $new_image;
        }
        $Projects->update($date);
        if($old_image && $new_image){
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('project')
            ->with('success','Projects Update !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Project=Project::findOrFail($id);
        $Project->delete();
        return Redirect::route('project')
            ->with('wring','Project deleted !');
    }
    protected function uploadImage(Request $request)
    {
        if(!$request->hasFile('project_image_1')) {
            return;
        }
        $file= $request->file('project_image_1');
        $path='http://127.0.0.1:8000/storage/'.$file->store('uploads',[
            'disk'=>'public'
        ]);
        return $path;
    }
}
