<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'merchant'  => $this->merchant->name,
            'status'    => $this->status ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-danger">Not Approved</span>',
            'action'    => !$this->status ? '<button onclick="approve(this)" class="btn btn-sm btn-success" data-id="'.$this->id.'">Approved</button>' : '',
        ];
    }
}
