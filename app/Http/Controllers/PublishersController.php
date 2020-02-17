<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublishersController extends Controller
{
    public function index()
    {
        return view('admin.publisher.index')->with('publishers', Publisher::all());
    }

    public function create()
    {
        return view('admin.publisher.create');
    }

    public function store(Request $request)
    {
        $name = Str::slug($request->photo->getClientOriginalName());
        $filename = str_replace(array('jpg','jpeg','png', 'svg'), '',$name);
        $filename = $filename . time() . '.' . $request->photo->getClientOriginalExtension();
        $image = $request->photo->storeAs('storage/publishers', $filename);
        Publisher::create([
            'fullname' => $request->fullname,
            'photo' => $image,
            'title' => $request->title,
            'school' => $request->school,
        ]);
        session()->flash('success', 'Yazar başarıyla eklendi.');
        return redirect(route('publisher.index'));
    }

    public function edit($id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('admin.publisher.create')->with('publisher', $publisher);
    }

    public function update(Request $request, $id)
    {
        $publisher = Publisher::findOrFail($id);
        $this->validate($request, [
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->only([
            'fullname', 'school', 'title'
        ]);
        if ($request->hasFile('photo')) {
            $name = Str::slug($request->photo->getClientOriginalName());
            $filename = str_replace(array('jpg','jpeg','png', 'svg'), '',$name);
            $filename = $filename . time() . '.' . $request->photo->getClientOriginalExtension();
            $photo = $request->photo->storeAs('storage/publishers', $filename);
            @unlink('storage/' . $publisher->photo);
            $data['photo'] = $photo;
        }
        $publisher->update($data);
        session()->flash('success', 'Yazar güncellendi.');
        return redirect(route('publisher.index'));
    }

    public function destroy($id)
    {
        $publisher = Publisher::findOrFail($id);
        @unlink('storage/'.$publisher->photo);
        $publisher->forceDelete();
        session()->flash('success', 'Yazar silindi');
        return redirect()->back();
    }
}
