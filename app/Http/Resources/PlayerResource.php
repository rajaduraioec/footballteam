<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'playerImageURI' => $this->playerImageURI,
            'team' => $this->when($request->is('*/player/info'), new TeamResource($this->team)),
        ];
    }
}
