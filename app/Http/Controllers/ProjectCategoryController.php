<?php

namespace App\Http\Controllers;

use App\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProjectCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $project_categories = ProjectCategory::with(
            [
                'projects' => function ($query) {
                    $query->orderBy('display_order', 'asc');
                },
            ]
        )->get();

        return Route::currentRouteName() == 'portfolio' ?
            view('portfolio')->with('project_categories', $project_categories)
            : view('admin.index')->with('project_categories', $project_categories);
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
        $validated_data = $request->validate([
            'category' => 'required|max:50|alpha'
        ]);
        $category = ProjectCategory::create($validated_data);
        return response()->json($category, 201);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectCategory $projectCategory)
    {
        $projectCategory->delete();
        return response()->json('Category deleted succesfully', 204);
    }
}
