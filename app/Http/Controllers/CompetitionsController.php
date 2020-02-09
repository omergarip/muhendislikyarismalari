<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Http\Requests\Competitions\CreateCompetitionRequest;
use App\Http\Requests\Competitions\UpdateCompetitionRequest;
use Analytics;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Analytics\Period;

class CompetitionsController extends Controller
{

    public function index()
    {
        $pages = Analytics::performQuery(
            Period::years(1),
            'ga:pageviews',
            [
                'metrics' => 'ga:pageviews',
                'dimensions' => 'ga:pagePath',
                'max-results' => '5'
            ]
        );

        //dd($pages);
        return view('competitions.index')->with('competitions', Competition::paginate(5));
    }

    public function create()
    {
        return view('admin.competitions.create');
    }

    public function store(CreateCompetitionRequest $request)
    {
        $name1 = Str::slug($request->image->getClientOriginalName());
        $filename1 = str_replace(array('jpg','jpeg','png', 'svg'), '',$name1);
        $filename1 = $filename1 . time() . '.' . $request->image->getClientOriginalExtension();
        $image = $request->image->storeAs('storage/competitions', $filename1);
        Competition::create([
            'organizer' => $request->organizer,
            'title' => $request->title,
            'user_id' => auth()->id(),
            'image' => $image,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'reward' => $request->reward,
            'detail' => $request->detail,
            'fbappid' => '2012401338806092'
        ]);
        session()->flash('success', 'Competition created successfully.');
        return redirect(route('competitions.dindex'));
    }

    public function show($slug, Request $request)
    {
        $competition = Competition::whereSlug($slug)->first();
        $url = $request->fullUrl();
        $uri = $request->path();
        $start_date = Carbon::instance($competition->created_at);
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
         $end  = $competition->deadline;
         $now = today();

         if ($now <= $end)
            $difference = $now->diffInDays($end);
          else
            $difference = -1;
          return view('competitions.show')
              ->with('url', $url)
              ->with('competition', $competition)
              ->with('difference', $difference)
              ->with('pageViews', $pageViews);
    }

    public function edit($slug)
    {
        $competition = Competition::whereSlug($slug)->first();
        return view('admin.competitions.create')->with('competition', $competition);
    }

    public function update(UpdateCompetitionRequest $request, Competition $competition)
    {
        $data = $request->only([
            'organizer', 'title', 'contents',
            'deadline', 'reward', 'detail'
        ]);

        if($request->hasFile('image')) {
            $name = Str::slug($request->image->getClientOriginalName());
            $filename = str_replace(array('jpg','jpeg','png', 'svg'), '',$name);
            $filename = $filename . time() . '.' . $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('storage/competitions', $filename);
            @unlink('storage/'.$competition->image);
            $data['image'] = $image;
        }
        $data['user_id'] = auth()->id();
        $competition->update($data);
        session()->flash('success', 'Competition updated succesfully');
        return redirect(route('competitions.dindex'));
    }

    public function destroy($id)
    {
        $competition = Competition::withTrashed()->where('id', $id)->firstOrFail();
        if($competition->trashed()) {
            @unlink('storage/'.$competition->image);
            $competition->forceDelete();
        } else {
            $competition->delete();
        }
        session()->flash('success', 'Competition deleted succesfully');
        return redirect(route('competitions.dindex'));
    }

    public function dashboardIndex()
    {
        $removed_competitions = Competition::onlyTrashed()->get();
        return view('admin.competitions.index')
            ->with('competitions', Competition::all())
            ->with('removed_competitions', $removed_competitions);

    }

    public function trashed()
    {
        $trashed = Competition::onlyTrashed()->get();
        return view('competitions.dindex')->withCompetitions($trashed);
    }

    public function restore($id)
    {
        $competition = Competition::withTrashed()->where('id', $id)->firstOrFail();
        $competition->restore();
        session()->flash('success', 'Competition restored succesfully');
        return redirect()->back();
    }


}
