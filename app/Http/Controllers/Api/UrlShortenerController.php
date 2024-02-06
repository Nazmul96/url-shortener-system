<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUrlShortenerRequest;
use App\Models\UrlShortener;
use App\Services\ShortUrlService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{
   
    public function shortenUrl(Request $request,ShortUrlService $shortUrlService): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $url = UrlShortener::create([
            'original_url' => $request->input('original_url'),
            'short_url' => $shortUrlService->getUniqueShortUrl(),
        ]);

        if (! $url) {
            return response()->json(['error' => 'Short url failed to create!'], 402);
        }

        return response()->json(['short_url' => config('app.url').'/url/'.$url->short_url], 201);
    }
}
