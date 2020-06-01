<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertProject;
use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    /**
     * Returns listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with([
            'category' => function ($query) {
                $query->select('id', 'category');
            }
        ])
            ->orderBy('display_order', 'asc')
            ->get();

        return response()->json($projects, 200);
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
    public function store(UpsertProject $request)
    {
        // incrementing display_order, if newly coming already exist
        $display_order = $request->validated()['display_order'];
        $existingProject = Project::where('display_order', $display_order)->first();
        if ($existingProject) {
            Project::where('display_order', '>=', $display_order)
                ->increment('display_order', 1);
        }

        $project = Project::create($request->validated());
        // loading relationship of project with category
        $project->load([
            'category' => function ($query) {
                $query->select('id', 'category');
            }
        ]);
        return response()->json($project, 201);
    }

    /**
     * Store the image to storage public directory
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeImage(Request $request)
    {
        $file = $request->file('file');
        $dir = "public/images";
        $path = $file->store($dir);
        return str_replace("public", '/storage', $path);
    }

    /**
     * Deletes an image from storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request)
    {
        $imagePath = $request->input('imgPath');
        $imageName = str_replace('/storage/images/', '', $imagePath);
        Storage::delete('/public/images/' . $imageName);
        return ['success' => 200];
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
    public function update(UpsertProject $request, Project $project)
    {
        $oldOrder = $project->display_order;
        $newOrder = $request->validated()['display_order'];
        if ($oldOrder !== $newOrder) {
            Project::where('display_order', '>=', $newOrder)
                ->increment('display_order', 1);
        }
        // removing old image from storage
        if ($project->image !== $request->validated()['image']) {
            $imagePath = $project->image;
            $imageName = str_replace('/storage/images/', '', $imagePath);
            Storage::delete('/public/images/' . $imageName);
        }

        // updating project
        $project->update($request->validated());

        return ['status' => 204];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $display_order = $project->display_order;
        $project->where('display_order', '>', $display_order)
            ->decrement('display_order', 1);
        $project->delete();
        return response()->json('Project deleted successfully', 204);
    }
}
