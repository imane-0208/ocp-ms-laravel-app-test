<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    //store comment

    public function store(CommentRequest $request)
    {
        $requestData = $request->all();
        Comment::create($requestData);

        return redirect()->back()->with('success', 'Data inserted successfully');

    }

    //delete comment

    function destroy($id){

        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Data deleted successfully');
    }

    //update comment 

    function update(CommentRequest $request){

        Comment::where('id', $request->comment_id)->update([
            'content' => $request->content
            
         ]);

        return redirect()->back()->with('success', 'Data updated successfully');
    }
}
