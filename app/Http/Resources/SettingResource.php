<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'company_name' => $this->company_name,
            'event_name' => $this->event_name,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng
        ];
    }
}
