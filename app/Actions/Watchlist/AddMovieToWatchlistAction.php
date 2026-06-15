<?php

namespace App\Actions\Watchlist;

use App\Contracts\MovieProviderInterface;
use App\Models\Movie;
use App\Models\User;
use App\Models\WatchlistItem;

class AddMovieToWatchlistAction
{
    public function __construct(
        private readonly MovieProviderInterface $movieProvider
    ) {}

    public function execute(User $user, array $data): WatchlistItem
    {
        $movieData = isset($data['external_id'])
            ? $this->movieProvider->findByExternalId($data['external_id'])
            : $this->movieProvider->findByTitle($data['title']);

        $movie = Movie::firstOrCreate(
            ['external_id' => $movieData->externalId],
            $movieData->toArray()
        );

        return WatchlistItem::firstOrCreate([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);
    }
}
