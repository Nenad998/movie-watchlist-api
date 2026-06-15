<?php

namespace App\Data;

class MovieData
{
    public function __construct(
        public readonly string $externalId,
        public readonly string $title,
        public readonly ?string $year,
        public readonly ?string $poster,
        public readonly ?string $plot,
        public readonly ?string $genre,
        public readonly ?string $director,
        public readonly ?string $runtime,
        public readonly array $rawPayload,
    ) {
    }

    public function toArray(): array
    {
        return [
            'external_id' => $this->externalId,
            'external_source' => 'omdb',
            'title' => $this->title,
            'year' => $this->year,
            'poster' => $this->poster,
            'plot' => $this->plot,
            'genre' => $this->genre,
            'director' => $this->director,
            'runtime' => $this->runtime,
            'raw_payload' => $this->rawPayload,
        ];
    }
}