<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //create post

    public function store(PostRequest $request)
    {
        $requestData = $request->all();
        $filename = time() . $request->file('img_path')->getClientOriginalName();
        $path = $request->file('img_path')->storeAs('images', $filename, 'public');
        $requestData['img_path'] = '/storage/' . $path;
        Post::create($requestData);

        return redirect()
            ->back()
            ->with('success', 'Data inserted successfully');
    }

    //get one post

    public function getOnePost($id)
    {
        $post = Post::where('id', $id)
            ->with([
                'comments' => function ($q) {
                    $q->with([
                        'user' => function ($q) {
                            $q->get();
                        },
                    ]);
                    $q->with([
                        'replies' => function ($q) {
                            $q->with([
                                'user' => function ($q) {
                                    $q->get();
                                },
                            ]);
                        },
                    ]);
                },
                'user' => function ($q) {
                    $q->first();
                },
            ])
            ->first();
        return view('post', compact('post'));
    }

    //delete post
    function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()
            ->back()
            ->with('success', 'Data deleted successfully');
    }

    //update post
    function update(PostRequest $request)
    {
        Post::where('id', $request->post_id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Data updated successfully');
    }
}
