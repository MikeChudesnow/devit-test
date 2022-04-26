<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $post = $this->resource;
        return [
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
            'pub_date' => $post->pub_date
        ];
    }
}
