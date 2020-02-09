<?php

namespace App\Http\Controllers;

use App\Content;
use App\ContentMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentsMediaController extends Controller
{

    public function create()
    {
        return view('admin.contents-media.create');
    }

    public function store(Request $request)
    {
        $content = Content::latest()->take(1)->get();
        $name = Str::slug($request->file->getClientOriginalName());
        $filename = str_replace(array('jpg', 'jpeg', 'png', 'svg'), '', $name);
        $filename = $filename . time() . '.' . $request->file->getClientOriginalExtension();
        $image = $request->file->storeAs('storage/contents', $filename);
        ContentMedia::create([
            'image' => $image,
            'content_id' => $content[0]->id,
        ]);
    }

    public function edit($id)
    {
        $media = ContentMedia::where('content_id', $id)->latest()->paginate(5);
        return view('admin.contents-media.create')->with('media', $media);
    }

    public function destroy($id)
    {
        $media = ContentMedia::findOrFail($id);
        @unlink('storage/'.$media->image);
        $media->forceDelete();
        session()->flash('success', 'Fotoğraf silindi');
        return redirect()->back();
    }
}
