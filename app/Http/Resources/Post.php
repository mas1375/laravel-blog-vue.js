<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body'=> $this->body,
            'cover_image' => $this->cover_image,
            'created_at' => $this->created_at,
            'author' => $this->user->name
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'authorUrl' => url('http://malisadeghi.ir'),
            'author' => User::find($this->user_id)
        ];
    }

}
