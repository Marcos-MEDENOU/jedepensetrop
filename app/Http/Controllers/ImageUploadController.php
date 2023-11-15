<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        $imageFullName = $request->file('image_principale')->getClientOriginalName();

        $path = $request->file('image_principale')->storeAs('uploads', $imageFullName, 'public');
        return response()->json(['location' => "/storage/$path"]);
    }
}
