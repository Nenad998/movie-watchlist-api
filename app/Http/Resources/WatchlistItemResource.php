<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WatchlistItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'personal_rating' => $this->personal_rating,
            'notes' => $this->notes,
            'watched_at' => $this->watched_at,
            'movie' => [
                'id' => $this->movie->id,
                'external_id' => $this->movie->external_id,
                'title' => $this->movie->title,
                'year' => $this->movie->year,
                'poster' => $this->movie->poster,
                'plot' => $this->movie->plot,
                'genre' => $this->movie->genre,
                'director' => $this->movie->director,
                'runtime' => $this->movie->runtime,
            ],
        ];
    }
}
