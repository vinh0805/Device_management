<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use reponse;
use Illuminate\Support\Facades\input;
use App\http\Requests;
use App\Models\DeviceUser;

class PostController extends Controller
{
    public function saveAssgin(Request $request)
    {

    }

    public function addPost(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'body' => 'required'
        );
        $validator = Validator::make (input::all(), $rules);
        if ($validator->fails())
            return response::json(array('errors' => $validator->getMessageBag()->toarray()));
        else {
            $post = new post;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();
            return response()->json($post);
        }
    }

    public function showHistory(Request $request, $deviceUserId)
    {
        $deviceUser = DeviceUser::find($deviceUserId)->get();
        return reponse()->json($deviceUser);
    }











//    /**
//     * Handle the incoming request.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function __invoke(Request $request)
//    {
//        //
//    }
}
