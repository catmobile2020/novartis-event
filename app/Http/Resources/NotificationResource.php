<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id'=>$this->id,
            'title'=>$this->data['title'],
            'message'=>$this->data['body'],
            'type'=>$this->data['type'],
//            'is_read'=>$this->read_at ? true : false,
            'created_at'=>Carbon::parse($this->created_at)->format('d-m-Y h:i A'),
        ];
        return $data;
    }

}
