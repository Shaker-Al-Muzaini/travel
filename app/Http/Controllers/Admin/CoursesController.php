<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Courses::all();
        return response()->json(['projects' => $projects], 200);
    }

    public function for_project()
    {
        return Courses::limit(4)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $validatedData = $request->validate([
//            'name' => 'required|max:255',
//            'description' => 'required',
//            'image_1' => 'required|image|max:2048',
//            'image_2' => 'required|image|max:2048',
//            'features' => 'required',
//            'link' => 'required',
//        ]);
//
//        $project = Project::create($validatedData);
//
//        return response()->json(['project' => $project], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $project = Courses::findOrFail($id);
//            return $project;
//
            return response()->json([
                'success' => true,
                'data' => [
                    'Courses' => $project
                ],
                'message' => trans('messages.show_success', ['name' => 'المشروع'])
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => trans('messages.not_found', ['name' => 'Courses'])
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => trans('messages.error', ['action' => 'عرض', 'name' => 'Courses'])
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, Courses $project)
    {
//        $validatedData = $request->validate([
//            'name' => 'required|max:255',
//            'description' => 'required',
//            'image_1' => 'required|image|max:2048',
//            'image_2' => 'required|image|max:2048',
//            'features' => 'required',
//            'link' => 'required',
//        ]);
//
//        $project->update($validatedData);
//
//        return response()->json(['project' => $project], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        $project->delete();
//        return response()->json(null, 204);
    }
}

