<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_service)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'content' => 'required'
        ]);
        if($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation Error'
            ], 400);  
        }
        $service = Service::find($id_service);
        if(!$service)
            return response([
                'error' => 'Service not found'
            ]);
        //dd($service);
        $comment = $service->comments()->create([
            'content' => $data['content']
        ]);

        return response([
            'comment' => $comment,
            'message' => 'Comment added with sucess'
        ], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $comment = Comment::find($id);
        if($comment == null) {
            return response([
                'error' => 'Resource Not Found'
            ]);
        }
        $comment->delete();
        return response([
            'message' => 'Comment deleted with success'
        ], 202);


    }
}
