<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OT;

#[OT\Schema(schema: 'Blog', title: 'Blog')]
class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    #[OT\Property(property: 'title', type: 'string', nullable: false)]
    #[OT\Property(property: 'content', type: 'string', nullable: true)]
    #[OT\Property(property: 'created_at', type: 'string', nullable: false)]
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at
        ];
    }
}
