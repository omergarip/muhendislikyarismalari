<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Competition;
use App\Content;
use App\ContentSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $competitions = Competition::latest()->take(2)->get();
        $first_content = Content::first();
        $contents = Content::latest()->get();
        $announcements = Announcement::latest()->take(2)->get();
        $first = ContentSeries::where('link', '=', 'usctm')->get();
        $series = ContentSeries::where('link', '!=', 'usctm')->get();

        return view('index', compact('competitions', 'contents',
            'announcements', 'first' ,'series', 'first_content'));

    }
}
