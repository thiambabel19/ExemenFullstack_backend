<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RvResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $medecin = $this->medecins()->get()[0];
        $patient = $this->patients()->get()[0];
        return [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'date' => $this->date,
            'patient' => $patient->prenom .' '.$patient->nom,
            'medecin' => $medecin->prenom .' '. $medecin->nom
        ];
    }
}