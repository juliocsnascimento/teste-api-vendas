<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'seller' => $this->seller,
            'seller_name' => $this->seller()->first()->name,
            'saller_commission_percent' => $this->commission_percent,
            'saller_commission_value' => $this->commission_value,
            'value' => $this->value,
            'date' => Carbon::make($this->date)->format('Y-m-d'),
        ];
    }
}
