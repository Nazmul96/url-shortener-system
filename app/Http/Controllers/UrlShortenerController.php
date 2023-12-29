<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    public function url_shortener(){
        return view('url_shortener');
    }

    public function url_shortener_store(StoreUrlRequest $request){
        $originalUrl = $request->input('url');
        $code = Str::random(10); 
        
        $shortUrl = UrlShortener::create([
            'user_id' => Auth::id(),
            'original_url' => $originalUrl,
            'short_url' => route('url.redirect', ['code' => $code]),
            'short_code' => $code,
        ]);

        return redirect()->route('dashboard');
    }

    public function url_redirect(Request $request){
        $urlShortener = UrlShortener::where('id', base64_decode($request->id))->first();
        if (!$urlShortener) {
            abort(404);
        }
        $urlShortener->increment('click_count');
    
        return redirect($urlShortener->original_url);
    }

}
