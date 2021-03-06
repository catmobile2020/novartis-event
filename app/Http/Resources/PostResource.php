<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'content'=>$this->content,
            'photo'=>$this->photo,
            'owner'=>AccountResource::make($this->user),
            'comments'=>CommentResource::collection($this->comments),
            'created_at'=>$this->created_at->format('d-m-Y h:i A'),
        ];
    }
}
