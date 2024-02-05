<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function image()
    {
        $image = Image::all();
        return view("image",compact('image'));
    }
    public function imageUpload(Request $request)
    {
        // image validator
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // image path
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move('upload', $imageName);

        // upload image in db
        $imageUpload = new Image;
        $imageUpload->image = $imageName;
        $imageUpload->save();

        return redirect()->back()->with("success", "Image uploaded successfully");
    }
}
