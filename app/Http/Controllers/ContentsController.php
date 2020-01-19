<?php

namespace App\Http\Controllers;

use App\Content;
use App\ContentMedia;
use App\ContentSeries;
use Analytics;
use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Analytics\Period;

class ContentsController extends Controller
{
    public function index(Request $request)
    {
        $uri = $request->path();
        return view('contents.index')
            ->with('contents', Content::where('status', '=', 'on')->latest()->paginate(5))
            ->with('series', ContentSeries::all())
            ->with('uri', $uri);
    }

    public function create()
    {
        return view('contents.create')
            ->with('series', ContentSeries::all())
            ->with('publishers', Publisher::all());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $name = Str::slug($request->cover->getClientOriginalName());
        $filename = str_replace(array('jpg','jpeg','png', 'svg'), '',$name);
        $filename = $filename . time() . '.' . $request->cover->getClientOriginalExtension();
        $cover = $request->cover->storeAs('storage/contents', $filename);
        Content::create([
            'cover' => $cover,
            'title' => $request->title,
            'page_title' => $request->page_title,
            'user_id' => auth()->id(),
            'series_link' => $request->series_link,
            'description' => $request->description,
            'status' => 'off',
            'fbappid' => '2012401338806092',
        ]);

        session()->flash('success', 'Content is created successfully.');
        return redirect(route('contents.second'));
    }

    public function show($link, $slug, Request $request)
    {
        $content = Content::whereSlug($slug)->first();
        $uri = $request->path();
        $url = $request->fullUrl();
        $start_date = Carbon::instance($content->created_at);
        $analyticsData = Analytics::performQuery(
            Period::create($start_date->subDays(1), today()->endOfDay()),
            'ga:pageviews',
            [
                'metrics' => 'ga:pageviews',
                'dimensions' => 'ga:pagePath',
                'filters' => 'ga:pagePath==/'.$uri
            ]
        );
        $pageViews = $analyticsData['totalsForAllResults']['ga:pageviews'];

        return view('contents.show')
            ->with('url', $url)
            ->with('content', $content)
            ->with('pageViews', $pageViews)
            ->with('series', ContentSeries::where('link', '=', $content->series_link)->first());
    }

    public function edit($slug)
    {
        $content = Content::whereSlug($slug)->first();
        return view('contents.create')->with('content', $content)->with('series', ContentSeries::all());
    }

    public function update(Request $request, $slug)
    {
//        $content = Content::whereSlug($slug)->first();
//        $this->validate($request, [
//            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
//        if ($request->hasFile('cover')) {
//            $name = Str::slug($request->cover->getClientOriginalName());
//            $filename = str_replace(array('jpg','jpeg','png', 'svg'), '',$name);
//            $filename = $filename . time() . '.' . $request->cover->getClientOriginalExtension();
//            $cover = $request->cover->storeAs('storage/contents', $filename);
//        }
//        $content->update([
//            'cover' => $cover,
//            'title' => $request->title,
//            'page_title' => $request->page_title,
//            'user_id' => auth()->id(),
//            'series_link' => $request->series_link,
//            'description' => $request->description,
//            'text' => $request->text,
//            'status' => 'off',
//            'fbappid' => '2012401338806092',
//        ]);
//
//        session()->flash('success', 'Content is created successfully.');
//        return back();

    }

    public function destroy($id)
    {
        //
    }

    public function series($link, Request $request)
    {
        $uri = $request->path();
        $contents = Content::where('series_link', '=', $link)->paginate(5);
        return view('contents.index', compact('uri'))
            ->with('contents', $contents)
            ->with('series', ContentSeries::all());
    }

    public function second()
    {
        return view('contents.second');
    }

    public function sstore(Request $request)
    {
        if ($request->hasFile('image')) {
            $name = Str::slug($request->image->getClientOriginalName());
            $filename = str_replace(array('jpg','jpeg','png', 'svg'), '',$name);
            $filename = $filename . time() . '.' . $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('storage/contents', $filename);
        }

        $content = Content::latest()->get();
        dd($content->id);
        ContentMedia::create([
            'content_id' => $content->id,
            'image' => $image,
        ]);
        session()->flash('success', 'Content is created successfully.');
        return redirect(route('contents.last'));
    }

    public function last()
    {
        return view('contents.last');
    }
}
