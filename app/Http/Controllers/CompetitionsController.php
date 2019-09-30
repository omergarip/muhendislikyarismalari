<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Http\Requests\Competitions\CreateCompetitionRequest;
use App\Http\Requests\Competitions\UpdateCompetitionRequest;
use Analytics;
use Cocur\Slugify\Slugify;
use Spatie\Analytics\Period;

class CompetitionsController extends Controller
{

    public function index()
    {

        return view('competitions.index')->with('competitions', Competition::all());
    }

    public function create()
    {
        return view('competitions.create');
    }

    public function store(CreateCompetitionRequest $request)
    {
        $image = $request->image->store('competitions');
        Competition::create([
            'organizer' => $request->organizer,
            'title' => $request->title,
            'user_id' => auth()->id(),
            'image' => $image,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'reward' => $request->reward,
            'detail' => $request->detail,
            'fbappid' => '2012401338806092',
            'counter' => 0
        ]);
        session()->flash('success', 'Competition created successfully.');
        return redirect(route('competitions.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($slug)
    {
        $competition = Competition::whereSlug($slug)->first();
        return view('competitions.create')->with('competition', $competition);
    }

    public function update(UpdateCompetitionRequest $request, Competition $competition)
    {
        $data = $request->only([
            'organizer', 'title', 'content',
            'deadline', 'reward', 'detail'
        ]);

        if($request->hasFile('image')) {
            $image = $request->image->store('competitions');
            $competition->deleteImage();
            $data['image'] = $image;
        }
        $data['user_id'] = auth()->id();
        $competition->update($data);
        session()->flash('success', 'Competition updated succesfully');
        return redirect(route('competitions.index'));
    }

    public function destroy($id)
    {
        $competition = Competition::withTrashed()->where('id', $id)->firstOrFail();
        if($competition->trashed()) {
            $competition->deleteImage();
            $competition->forceDelete();
        } else {
            $competition->delete();
        }
        session()->flash('success', 'Competition deleted succesfully');
        return redirect(route('competitions.index'));
    }
    public function trashed()
    {
        $trashed = Competition::onlyTrashed()->get();

        return view('competitions.index')->withCompetitions($trashed);
    }

    public function restore($id)
    {
        $competition = Competition::withTrashed()->where('id', $id)->firstOrFail();
        $competition->restore();
        session()->flash('success', 'Competition restored succesfully');
        return redirect()->back();
    }
}
