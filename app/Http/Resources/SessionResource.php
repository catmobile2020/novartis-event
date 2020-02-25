<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'location' => $this->location,
            'time_from' => Carbon::parse($this->time_from)->format('h:i A'),
            'time_to' => Carbon::parse($this->time_to)->format('h:i A'),
            'speakers' => AccountResource::collection($this->speakers->pluck('user')),
        ];
    }
}
