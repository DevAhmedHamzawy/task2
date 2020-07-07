<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        // Get Father And GrandFather Name
        $the_name = explode(" ", $this->name);

        return [
            'id' => $this->id, 
            'person_id' => $this->person_id,
            'type' => $this->type,
            'name' => $this->name,
            'birthdate' => $this->birthdate,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'father_name' => $the_name[1] ?? null,
            'grandfather_name' => $the_name[2] ?? null,
        ];
    }
}
