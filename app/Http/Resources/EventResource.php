<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'date'=>Carbon::parse($this->date)->format('d-m-Y'),
            'city'=>$this->city,
            'address'=>$this->address,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'active'=>(boolean)$this->active,
        ];
    }
}
