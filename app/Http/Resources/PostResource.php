<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'status' => $this->status->value ?? $this->status,

            'author' => [
                'id' => $this->author?->id,
                'name' => $this->author?->name,
            ],

            'approved_by' => $this->approved_by,
            'rejected_reason' => $this->rejected_reason,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}