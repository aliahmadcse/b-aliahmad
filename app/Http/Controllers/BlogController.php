<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogTag;
use App\Http\Requests\UpsertBlog;
use App\ManageStorage\s3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog');
    }

    /**
     * This functions returns limited blog fields along with tag
     * for backend blog posts list in tabular form
     *
     * @return Response
     */
    public function getBlogs()
    {
        $blogs = Blog::with([
            'tag' => function ($query) {
                $query->select('id', 'tag');
            }
        ])->select(
            'id',
            'blog_tag_id',
            'title',
            'is_published'
        )->orderBy('created_at', 'desc')
            ->get();

        return response()->json($blogs, 200);
    }

    /**
     * This method is used for api call, it returns the paginated blog
     * posts data to the front end
     *
     * @return Response
     */
    public function paginateBlog()
    {
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
            ->paginate(5);

        return response()->json($blogs, 200);
    }

    /**
     * Returns a single resource
     *
     * @param Blog $blog
     * @return Response
     */
    public function blogById(Blog $blog)
    {
        $blog->load([
            'author' => function ($query) {
                $query->select('id', 'name', 'avatar');
            },
            'tag' => function ($query) {
                $query->select('id', 'tag');
            }
        ]);
        return response()->json($blog, 200);
    }

    /**
     * Finds and returns all the blogs related to single tag
     *
     * @param BlogTag $tag
     * @return Response
     */
    public function blogByTag(BlogTag $tag)
    {
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
        )->where('blog_tag_id', $tag->id)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return response()->json($blogs, 200);
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
     * Saves and returns the blog header image url
     * 
     * @param Request $request
     * @return $fileUrl the saved image url
     */
    public function storeHeaderImage(Request $request)
    {
        $fileUrl = s3::save($request->file('file'), 'public/blogheader');
        return $fileUrl;
    }

    public function deleteHeaderImage(Request $request)
    {
        $imgName = basename($request->input('imgPath'));
        s3::delete('public/blogheader/' . $imgName);
        return ['success' => 200];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpsertBlog $request)
    {
        $validated_data = $request->validated();
        $validated_data['author_id'] = Auth::user()->id;
        $blog = Blog::create($validated_data);
        $blog->load([
            'tag' => function ($query) {
                $query->select('id', 'tag');
            }
        ]);
        return response()->json($blog, 201);
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
