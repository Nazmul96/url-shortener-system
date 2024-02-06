<?php

namespace App\Services;

use App\Models\UrlShortener;
use Illuminate\Support\Str;

class ShortUrlService
{
    public function getUniqueShortUrl(): string
    {
        return Str::random(6) . '_'.now()->timestamp;
    }
}
