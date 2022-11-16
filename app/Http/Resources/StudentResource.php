<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'national_code' => $this->national_code,
            'birth_date' => $this->birth_date,
            'state' => $this->state,
            'city' => $this->city,
            'gender' => $this->gender,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'classes' => $this->whenLoaded('classes', ClassResource::collection($this->classes)),
            'class_count' => $this->whenLoaded('classes', ClassResource::collection($this->classes))->count()
        ];
    }
}
