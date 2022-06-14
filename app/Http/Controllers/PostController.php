<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request, Website $website)
    {
        $data = $request->validated();

        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'website_id' => $website->id
        ]);

        return response()->json([
            'message' => 'Post created successfully'
        ], 200);
    }
}
