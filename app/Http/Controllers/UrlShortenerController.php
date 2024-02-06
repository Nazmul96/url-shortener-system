<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUrlShortenerRequest;
use App\Http\Requests\StoreUrlShortenerRequest;
use App\Models\UrlShortener;
use App\Services\ShortUrlService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UrlShortenerController extends Controller
{
    
    public function shortenUrlStore(StoreUrlShortenerRequest $request,ShortUrlService $shortUrlService): View|RedirectResponse
    {
        $url = UrlShortener::create([
            'user_id' => auth()->id(),
            'original_url' => $request->input('original_url'),
            'short_url' => $shortUrlService->getUniqueShortUrl(),
        ]);

        if (!$url) {
            return redirect()->back()->with('error', 'Failed to short url!');
        }

        return redirect()->route('dashboard')->with('success', 'Url shorten successfully done!');
    }


    public function delete(UrlShortener $url): RedirectResponse
    {

        return redirect()->back()->with('success', 'Url successfully deleted');
    }


}
