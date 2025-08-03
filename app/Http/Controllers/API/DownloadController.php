<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download(Request $request)
    {
        $path = $request->path;
        $path = public_path($path);
        $fileName = last(explode("/", $path));
        return \Response::download($path, $fileName);
    }

}
