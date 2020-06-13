<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::enableQueryLog();

        $blogs = Blog::with([
            'tag' => function ($query) {
                $query->select('id', 'tag');
            },
            'author' => function ($query) {
                $query->select('id', 'name', 'avatar');
            }
        ])->select(
            'id',
            'blog_tag_id',
            'author_id',
            'title',
            'description',
            'image',
            'is_published',
            'created_at',
            'updated_at'
        )->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // $queries = DB::getQueryLog();
        // return dd($queries);

        // $blogs = \App\User::with(['posts'])->get();


        return view('blog', compact('blogs'));
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
        //
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
    public function destroy($id)
    {
        //
    }
}
