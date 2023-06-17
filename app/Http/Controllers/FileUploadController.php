<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    //
    public function index()
    {
        return response()->view('fileupload.index');
    }
}
