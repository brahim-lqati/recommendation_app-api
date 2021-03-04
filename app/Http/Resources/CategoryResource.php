<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    $q = $request->query('q');
    $q == null ? $q = '' :'';
    if(!$request->route('id'))
        return parent::toArray($request);     
      
       $services = Service::where('category_id',$this->id)
                            ->where('name','like','%'.$q.'%')
                            ->paginate(5)->toArray();
        return [
            'id' => $this->id,
            'name_category' => $this->name_category,
            'services' => $services['data'],
            'current_page' => $services['current_page'],
            'last_page' => $services['last_page'],
            'totalServices' => $services['total']
        ];
    }
}
