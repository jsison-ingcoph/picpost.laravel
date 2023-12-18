<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('filename');
        $file->getClientOriginalName();
        $file->getClientOriginalExtension();
        $file->getRealPath();
        $file->getSize();
        $file->getMimeType();
        $destinationPath = 'uploads';
        if ($file->move($destinationPath, $file->getClientOriginalName())) {
            // 
        }
        // 
    }
}
