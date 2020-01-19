<?php

namespace App\Http\Controllers;

use App\Announcement;
use Analytics;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\Analytics\Period;

class AnnouncementsController extends Controller
{

    public function index(Request $request)
    {
        $uri = $request->path();
        return view('announcements.index')
            ->with('announcements', Announcement::latest()->paginate(5))
            ->with('categories', Category::all())
            ->with('uri', $uri);
    }

    public function create()
    {
        return view('announcements.create')->with('categories', Category::all());
    }

    public function store(Request $request)
    {
        $name1 = Str::slug($request->image->getClientOriginalName());
        $filename1 = str_replace(array('jpg','jpeg','png', 'svg'), '',$name1);
        $filename1 = $filename1 . time() . '.' . $request->image->getClientOriginalExtension();
        $image = $request->image->storeAs('storage/announcements', $filename1);
        Announcement::create([
            'organizer' => $request->organizer,
            'title' => $request->title,
            'user_id' => 1,
            'category_slug' => $request->category_slug,
            'image' => $image,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'reward' => '',
            'detail' => $request->detail,
            'fbappid' => '2012401338806092'
        ]);
        session()->flash('success', 'Competition created successfully.');
        return redirect(route('announcements.index'));
    }

    public function show($link, $slug, Request $request)
    {
        $announcement = Announcement::whereSlug($slug)->first();
        $url = $request->fullUrl();
        $uri = $request->path();
        $start_date = Carbon::instance($announcement->created_at);
        $analyticsData = Analytics::performQuery(
            Period::create($start_date->subDays(1), today()->endOfDay()),
            'ga:uniquePageviews',
            [
                'metrics' => 'ga:uniquePageviews',
                'dimensions' => 'ga:pagePath',
                'filters' => 'ga:pagePath==/'.$uri
            ]
        );
        $pageViews = $analyticsData['totalsForAllResults']['ga:uniquePageviews'];
        $end  = $announcement->deadline;
        $now = today();

        if ($now <= $end)
            $difference = $now->diffInDays($end);
        else
            $difference = -1;
        return view('announcements.show')
            ->with('url', $url)
            ->with('announcement', $announcement)
            ->with('difference', $difference)
            ->with('pageViews', $pageViews);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function categories($link, Request $request)
    {
        $uri = $request->path();
        $announcements = Announcement::where('category_slug', '=', $link)->paginate(5);
        return view('announcements.index', compact('uri'))
            ->with('categories', Category::all())
            ->with('announcements', $announcements);
    }
}
