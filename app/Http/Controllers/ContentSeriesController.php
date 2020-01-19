<?php

namespace App\Http\Controllers;

use App\Content;
use App\ContentSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentSeriesController extends Controller
{
    public function index()
    {
        return view('series.index')->with('series', ContentSeries::paginate(12));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $name = Str::slug($request->cover->getClientOriginalName());
        $filename = str_replace(array('jpg','jpeg','png', 'svg'), '',$name);
        $filename = $filename . time() . '.' . $request->cover->getClientOriginalExtension();
        $image = $request->cover->storeAs('storage/content-series', $filename);
        ContentSeries::create([
            'series_name' => $request->series_name,
            'cover' => $image,
            'link' => $request->link
        ]);
        session()->flash('success', 'Content Series is created successfully.');
        return redirect(route('series.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(ContentSeries $series)
    {
        $series->deleteImage();
        $series->delete();
        return back();
    }

}
