<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Image;

class PhotoController extends Controller
{

    public function store(Request $request)
    {
        //dd($request);
        $file = $request->file('file');        
        
        $path = public_path() . '/images/photos'; // S3 AWS
        $fileName = uniqid() . '-' . $file->getClientOriginalName();

        $img = Image::make($file->getRealPath());
        $size = $img->filesize();
        if($size > 5120)
        {
            $img->fit(800, 600, function ($constraint) {
                $constraint->upsize();
            })->save($path.'/'.$fileName);
        }
        else       
            $file->move($path, $fileName);

        $photo = new Photo();
        $photo->gallery_id = $request->input('gallery_id');
        $photo->file_name = $fileName;
        $photo->name = $file->getClientOriginalName();
        $photo->description = 'Sin descripción';
        $photo->save();

        return $photo;
    }

    public function edit($id)
    {
        $photo = Photo::find($id);
        return view('photo.edit')->with(compact('photo'));
    }

    public function update($id, Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'description' => 'min:5'
        ];
        $this->validate($request, $rules);

        $photo = Photo::find($id);
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $photo->save();

        $notification = 'La foto se ha editado correctamente.';
        return redirect('/galleries/'.$photo->gallery_id)->with(compact('notification')); // session('notification')
    }

    public function delete($id)
    {
        $photo = Photo::find($id);
        $deletedFile = File::delete(public_path('/images/photos/' .$photo->file_name));

        if ($deletedFile) {
            $photo->delete();
            $notification = 'La foto se ha eliminado correctamente.';
        }

        return back()->with(compact('notification')); // $notification session('notification')
    }

}
