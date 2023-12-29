<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUrlRequest;
use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{
    public function url_shortener_store(Request $request){
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $originalUrl = $request->input('url');
        $code = Str::random(10); 
        
        $shortUrl = UrlShortener::create([
            'user_id' => 1,
            'original_url' => $originalUrl,
            'short_url' => route('url.redirect', ['code' => $code]),
            'short_code' => $code,
        ]);

        return response()->json(['short_url' => $shortUrl->short_url]);
    }
}
