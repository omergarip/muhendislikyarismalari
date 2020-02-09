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
            ->with('contents', Content::where('status', '=', 'on')->latest()->paginate(10))
            ->with('series', ContentSeries::all())
            ->with('uri', $uri);
    }

    public function create()
    {
        return view('admin.contents.create')
            ->with('series', ContentSeries::all())
            ->with('publishers', Publisher::all());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $name = Str::slug($request->cover->getClientOriginalName());
        $filename = str_replace(array('jpg', 'jpeg', 'png', 'svg'), '', $name);
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
            'publisher_id' => 0,
            'fbappid' => '2012401338806092',
        ]);
        session()->flash('success', 'İçerik oluşturuldu.');
        return redirect(route('media.create'));
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
                'filters' => 'ga:pagePath==/' . $uri
            ]
        );
        $pageViews = $analyticsData['totalsForAllResults']['ga:pageviews'];
        return view('contents.show')
            ->with('url', $url)
            ->with('content', $content)
            ->with('pageViews', $pageViews)
            ->with('series', ContentSeries::where('link', '=', $link)->first());
    }

    public function edit($slug)
    {
        $content = Content::whereSlug($slug)->first();
        return view('admin.contents.create')
            ->with('content', $content)
            ->with('series', ContentSeries::all())
            ->with('publishers', Publisher::all());
    }

    public function update(Request $request, $slug)
    {
        $content = Content::whereSlug($slug)->first();
        $this->validate($request, [
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->only([
                'organizer', 'page_title', 'title',
            'description', 'publisher_id', 'series_link'
        ]);
        if ($request->hasFile('cover')) {
            $name = Str::slug($request->cover->getClientOriginalName());
            $filename = str_replace(array('jpg','jpeg','png', 'svg'), '',$name);
            $filename = $filename . time() . '.' . $request->cover->getClientOriginalExtension();
            $cover = $request->cover->storeAs('storage/contents', $filename);
            @unlink('storage/'.$content->image);
            $data['cover'] = $cover;
        }
        $data['user_id'] = auth()->id();
        $content->update($data);
        session()->flash('success', 'İçerik güncellendi.');
        return redirect(route('contents.dindex'));

    }

    public function destroy($id)
    {
        $content = Content::withTrashed()->where('id', $id)->firstOrFail();
        if($content->trashed()) {
            @unlink('storage/'.$content->image);
            $content->forceDelete();
        } else {
            $content->delete();
        }
        session()->flash('success', 'Competition deleted succesfully');
        return redirect(route('contents.dindex'));
    }

    public function dashboardIndex()
    {
        $contents = Content::where('status', '=', 'on')->latest()->paginate(10);
        $not_published = Content::where('status', '=', 'off')->latest()->paginate(10);
        $removed_contents = Content::onlyTrashed()->get();
        return view('admin.contents.index')
            ->with('contents', $contents)
            ->with('not_published', $not_published)
            ->with('removed_contents', $removed_contents);

    }

    public function trashed()
    {
        $trashed = Content::onlyTrashed()->get();
        return view('admin.contents.dindex')->withContents($trashed);
    }

    public function restore($id)
    {
        $competition = Content::withTrashed()->where('id', $id)->firstOrFail();
        $competition->restore();
        session()->flash('success', 'Competition restored succesfully');
        return redirect()->back();
    }

    public function series($link, Request $request)
    {
        $uri = $request->path();
        $contents = Content::where('series_link', '=', $link)->paginate(5);
        return view('contents.index', compact('uri'))
            ->with('contents', $contents)
            ->with('series', ContentSeries::all());
    }

    public function last()
    {
        $content = Content::latest()->take(1)->get();
        $medias = ContentMedia::where('content_id', '=', $content[0]->id)->get();
        return view('admin.contents.last')->with('medias', $medias)->with('title', $content[0]->title);
    }

    public function lastStore(Request $request)
    {
        $cId= Content::latest()->take(1)->get();
        $content = Content::findOrFail($cId[0]->id);
        $content->update([
            'text' => $request->text
        ]);

        return redirect(route('contents.dindex'));
    }

    public function lastEdit($id)
    {
        $content = Content::findOrFail($id);
        $medias = ContentMedia::where('content_id', '=',$id)->get();
        return view('admin.contents.last')
            ->with('content', $content)
            ->with('medias', $medias)
            ->with('title', $content->title);
    }

    public function lastUpdate(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $content->update([
            'text' => $request->text
        ]);
        return redirect(route('contents.dindex'));
    }


    public function publish($id)
    {
        $content = Content::findOrFail($id);
        $content->update([
            'status' => 'on'
        ]);
        return redirect()->back();
    }

    public function reverse($id)
    {
        $content = Content::findOrFail($id);
        $content->update([
            'status' => 'off'
        ]);
        return redirect()->back();
    }
}
