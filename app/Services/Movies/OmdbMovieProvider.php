<?php

namespace App\Services\Movies;

use App\Contracts\MovieProviderInterface;
use App\Data\MovieData;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class OmdbMovieProvider implements MovieProviderInterface
{
    public function findByTitle(string $title): MovieData
    {
        return $this->fetchMovie([
            't' => $title,
        ]);
    }

    public function findByExternalId(string $externalId): MovieData
    {
        return $this->fetchMovie([
            'i' => $externalId,
        ]);
    }

    private function fetchMovie(array $query): MovieData
    {
        $response = Http::timeout(5)
            ->retry(2, 200)
            ->get(config('services.omdb.url'), array_merge($query, [
                'apikey' => config('services.omdb.key'),
            ]));

        if (! $response->successful()) {
            throw new RuntimeException('Movie provider request failed.');
        }

        $data = $response->json();

        if (($data['Response'] ?? 'False') === 'False') {
            throw new RuntimeException($data['Error'] ?? 'Movie not found.');
        }

        return new MovieData(
            externalId: $data['imdbID'],
            title: $data['Title'],
            year: $data['Year'] ?? null,
            poster: $data['Poster'] ?? null,
            plot: $data['Plot'] ?? null,
            genre: $data['Genre'] ?? null,
            director: $data['Director'] ?? null,
            runtime: $data['Runtime'] ?? null,
            rawPayload: $data,
        );
    }
}
