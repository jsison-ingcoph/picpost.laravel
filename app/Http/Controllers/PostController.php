<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'caption' => 'required',
                'filename' => 'required',
            ]);
            $post = Auth::user()->posts()->create($validated);
            return response()->json([
                'msg' => 'Post created successfully.',
                'post' => $post,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Internal server error.',
                'err' => $th,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        try {
            if (Auth::user()->id !== $post->user_id) {
                return response()->json([
                    'msg' => 'Unauthorized access to the post.',
                ], 401);
            }
            return response()->json([
                'msg' => 'Post retrieved successfully.',
                'post' => $post,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Internal server error.',
                'err' => $th,
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
