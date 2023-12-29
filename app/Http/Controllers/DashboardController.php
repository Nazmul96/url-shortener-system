<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $all_short_url = UrlShortener::where('user_id',Auth::id())->orderByDesc('created_at')->paginate(10);
        return view('dashboard',compact('all_short_url'));
    }
}
