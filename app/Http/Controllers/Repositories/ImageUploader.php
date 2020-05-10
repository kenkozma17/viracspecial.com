<?php

namespace App\Http\Controllers\Repositories;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ImageUploader extends Controller
{

    # Save image to public folder
    public function uploadImage($image, $directory) {
        $imageArr = ['image' => $image];
        $validator = Validator::make($imageArr, [
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fileName = round(microtime(true) * 1000) . '.' .$image->extension();
        $image->move(public_path($directory), $fileName);
        $filePath = '/' .$directory . '/' . $fileName;

        return $filePath;
    }
}
