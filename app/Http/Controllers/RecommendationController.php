<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecommendationController extends Controller
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
    public function store(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'username' => 'required',
            'comment' => 'required',
            'rating' => 'required|numeric|min:0|max:5'
        ]);
       
        if($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation Error'
            ], 400);  
        }
        $service = Service::find($id);
        if(!$service)
            return response([
                'error' => 'Service not found'
            ]);
        //dd($service);
        $recom = $service->recommendations()->create([
            'username' => $data['username'],
            'comment' => $data['comment'],
            'rating' => $data['rating']
        ]);

        return response([
            'Recommendation' => $recom,
            'message' => 'Recommendation added with sucess'
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
        $recom = Recommendation::find($id);
        if($recom == null) {
            return response([
                'error' => 'Resource Not Found'
            ]);
        }
        $recom->delete();
        return response([
            'message' => 'Recommendation deleted with success'
        ], 202);
    }
}
