<?php

namespace App\Contracts;

use App\Data\MovieData;

interface MovieProviderInterface
{
    public function findByTitle(string $title): MovieData;

    public function findByExternalId(string $externalId): MovieData;
}
