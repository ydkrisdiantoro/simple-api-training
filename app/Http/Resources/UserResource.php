<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        try {
            $decrypted = Crypt::decrypt($this->niki);
            return [
                'name' => $this->name,
                'email' => $this->email,
                'nik' => $decrypted,
            ];
        } catch (\Throwable $th) {
            return [];
        }
    }
}
