<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(!$request->route('id')) {
            // return [
            //     'id' => $this->id,
            //     'name' => $this->name,
            //     'image' => $this->image,
            //     'address' => $this->address,
            //     'rating' => $this->rating,
            //     'latitude' => $this->latitude,
            //     'longitude' => $this->longitude,
            //     'avgRating' => (DB::table('recommendations') ->where('service_id',$this->id)->avg('rating')) * 20
              
            // ];
            return parent::toArray($request);
        }
            // 
        
        $service = Service::where('id',$this->id)->first();
        $city = $service->city;
        $category = $service->category;
        $recommendations = $service->recommendations;
        $avgRating = DB::table('recommendations')
                        ->where('service_id',$this->id)->avg('rating');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'address' => $this->address,
            'rating' => $this->rating,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'avgRating' => $avgRating * 20,
            'category' => $category,
            'city' => $city,
            'recommendations' => $recommendations
           

        ];
    }
    
}
