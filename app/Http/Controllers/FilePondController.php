<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FilePondController extends Controller
{
    //
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'foto' => 'required|image|mimes:png|max:2048',
        ]);
        //unique folder name
        $folderName = uniqid() . '-' . Auth::user()->id . '-' . now()->timestamp;
        //upload file
        $request->file('foto')->store('tmp/' . $folderName);
        TemporaryFiles::create([
            'folder' => $folderName,
            'filename' => $request->file('foto')->hashName(),
        ]);
        return $folderName;
    }

    public function destroy(Request $request)
    {
        Storage::deleteDirectory('tmp/' . $request->getContent());
        TemporaryFiles::where('folder', $request->getContent())->delete();
        return '';
    }
}
