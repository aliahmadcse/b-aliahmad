<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = [
            [
                'id' => 1,
                'title' => "Nadias Graden Restaurant",
                "image" => "https://b.imge.to/2019/07/19/5Oj5H.png",
                "category" => "web",
                "github" => "#",
                "link" => "#"
            ],
            [
                'id' => 2,
                'title' => "Hotel Reservation System",
                "image" => "https://b.imge.to/2019/07/19/5Oj5H.png",
                "category" => "web",
                "github" => "#",
                "link" => "#"
            ],
            [
                'id' => 3,
                'title' => "Product Landing page",
                "image" => "https://b.imge.to/2019/07/19/5Oj5H.png",
                "category" => "web",
                "github" => "#",
                "link" => "#"
            ],
            [
                'id' => 4,
                'title' => "Books Recommendation System",
                "image" => "https://b.imge.to/2019/07/19/5Oj5H.png",
                "category" => "ml",
                "github" => "#",
                "link" => "#"
            ],
            [
                'id' => 5,
                'title' => "Single Neuron Implementation",
                "image" => "https://b.imge.to/2019/07/19/5Oj5H.png",
                "category" => "ml",
                "github" => "#",
                "link" => "#"
            ],
        ];
        return view('portfolio')->with('projects', json_encode($projects));
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
