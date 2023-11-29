<?php

namespace App\Http\Controllers;

use App\Models\TemporaryImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class DeleteTemporaryImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request , $folder)
    {

        $temporaryImage = TemporaryImage::where('folder', $folder)->first();
        if ($temporaryImage) {
            Storage::deleteDirectory('public/images/tmp/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        // return response()->noContent();
    }
}
