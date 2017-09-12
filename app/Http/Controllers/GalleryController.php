<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\CreateGallery;
use App\Http\Requests\UpdateGallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(CreateGallery $request)
    {
        auth()->user()->galleries()->create(
            $request->only(['name', 'description'])
        );

        $notification = 'La galería se ha registrado correctamente.';
        return redirect('/home')->with(compact('notification')); // $notification session('notification')
    }

    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('gallery.show')->with(compact('gallery'));
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('gallery.edit')->with(compact('gallery'));
    }

    public function update(UpdateGallery $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->name = $request->input('name');
        $gallery->description = $request->input('description');
        $gallery->save();

        $notification = 'La galería se ha modificado correctamente.';
        return redirect('/home')->with(compact('notification'));
    }
}
