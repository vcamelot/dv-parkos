<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    private $withReservations;

    public function __construct($resource, $withReservations = false)
    {
        parent::__construct($resource);
        $this->withReservations = $withReservations;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $columns = [
            'id' => $this->id,
            'name' => $this->name,
            'location' => $this->location,
            'capacity' => $this->capacity
        ];
        if ($this->withReservations === true) {
            $columns['reservations'] = ReservationResource::collection($this->reservations);
        }

        return $columns;
    }
}
