<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store($postId, CommentStoreRequest $request){
        $params = $request->validated();
        $params['post'] = $postId;
        Comment::create($params);
        return back();
    }

    public function delete($id){
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }
}
