<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Comment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $q == null ? $q = '' :'';
        $services = Service::orderBy('rating','desc')
                            ->where('name','like','%'.$q.'%')
                            ->paginate(5);
        $labels = $services->toArray();
        //dd($labels);
        return response([
            'services' => ServiceResource::collection($services),
            'current_page' => $labels['current_page'],
            'last_page' => $labels['last_page'],
            'per_page' => $labels['per_page'],
            'totalServices' => $labels['total'],
            'message' => 'Retreive successfully'
        ],200);

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
        $service = Service::with(['category', 'city', 'comments' => function($query) {
           $query->orderByDesc('created_at');
        }])->where('id',$id)->get();
                            
                            
        return response([
            'service' => ServiceResource::collection($service),
            'message' => 'Retreive successfully'
        ],200);

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
