<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Competition;
use App\Content;
use App\ContentMedia;
use App\ContentSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
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

    public function list()
    {
        return view('test');
    }

    public function upload(Request $request)
    {
        $content = Content::latest()->take(1)->get();
        $name = Str::slug($request->file->getClientOriginalName());
        $filename = str_replace(array('jpg','jpeg','png', 'svg'), '',$name);
        $filename = $filename . time() . '.' . $request->file->getClientOriginalExtension();
        $image = $request->file->storeAs('contents', $filename);
        ContentMedia::create([
            'image' => $image,
            'content_id' => $content[0]->id,
        ]);
    }
}
