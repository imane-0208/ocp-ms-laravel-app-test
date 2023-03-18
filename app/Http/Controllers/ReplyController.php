<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    // store reply

    public function store(ReplyRequest $request)
    {
        
        $requestData = $request->all();
        Reply::create($requestData);

        return redirect()->back()->with('success', 'Data inserted successfully');

    }

    // delete reply
    
    function destroy($id){

        $reply = Reply::find($id);
        $reply->delete();

        return redirect()->back()->with('success', 'Data deleted successfully');
    }

    //update comment 

    function update(ReplyRequest $request){

        Reply::where('id', $request->reply_id)->update([
            'content' => $request->content
            
         ]);

        return redirect()->back()->with('success', 'Data updated successfully');
    }
}
