<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicFotoRequest;
use App\Http\Requests\UpdatePublicFotoRequest;
use App\Models\PublicFoto;
use App\Models\TemporaryFiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PublicFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('public-foto.index', [
            'public_fotos' => PublicFoto::where('user_id', Auth::user()->id)->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('public-foto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePublicFotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublicFotoRequest $request)
    {
        $tempFile = TemporaryFiles::where('folder', $request->foto)->first();
        //resize uploaded foto using intervetion
        $image = Image::make(storage_path('app/tmp/' . $tempFile->folder . '/' . $tempFile->filename))
            ->fit(50, 50);
        // save the image to thumbnails folder
        Storage::disk('public')
            ->put(Auth::user()->id . '/thumbnails/' . $tempFile->filename, $image->encode());
        //copy file from tmp to public
        Storage::copy('tmp/' . $tempFile->folder . '/' . $tempFile->filename, 'public/' . Auth::user()->id . '/' . $tempFile->filename);
        //save to database
        PublicFoto::create([
            'name' => $request->name,
            'path' => $tempFile->filename,
            'user_id' => Auth::user()->id,
        ]);
        //after upload delete
        Storage::deleteDirectory('tmp/' . $tempFile->folder);
        TemporaryFiles::where('folder', $tempFile->folder)->delete();
        //redirect to index
        return response()->redirectTo(route('public-foto.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublicFoto  $publicFoto
     * @return \Illuminate\Http\Response
     */
    public function show(PublicFoto $publicFoto)
    {
        //
        if ($publicFoto->user_id != Auth::user()->id) {
            return response()->redirectTo(route('public-foto.index'));
        }
        return response()->view('public-foto.show', compact('publicFoto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicFoto  $publicFoto
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicFoto $publicFoto)
    {
        //
        if ($publicFoto->user_id != Auth::user()->id) {
            return response()->redirectTo(route('public-foto.index'));
        }
        return response()->view('public-foto.edit', compact('publicFoto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePublicFotoRequest  $request
     * @param  \App\Models\PublicFoto  $publicFoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePublicFotoRequest $request, PublicFoto $publicFoto)
    {
        if ($publicFoto->user_id != Auth::user()->id) {
            return response()->redirectTo(route('public-foto.index'));
        }
        //ambil data file yang baru
        $tempFile = TemporaryFiles::where('folder', $request->foto)->first();
        //simpen foto yang lama
        $oldFoto = $publicFoto->path;
        //resize uploaded foto using intervetion
        $image = Image::make(storage_path('app/tmp/' . $tempFile->folder . '/' . $tempFile->filename))
            ->fit(50, 50);
        // save the image to thumbnails folder
        Storage::disk('public')
            ->put(Auth::user()->id . '/thumbnails/' . $tempFile->filename, $image->encode());
        //copy file from tmp to public
        Storage::copy('tmp/' . $tempFile->folder . '/' . $tempFile->filename, 'public/' . Auth::user()->id . '/' . $tempFile->filename);

        //update data public foto di database
        $publicFoto->update([
            'name' => $request->name,
            'path' => $tempFile->filename,
            'user_id' => Auth::user()->id,
        ]);
        //hapus file foto yang lama
        if ($oldFoto != 'default.png') {
            Storage::disk('public')->delete(Auth::user()->id . '/' . $oldFoto);
            Storage::disk('public')->delete(Auth::user()->id . '/thumbnails/' . $oldFoto);
        }
        //after upload delete
        Storage::deleteDirectory('tmp/' . $tempFile->folder);
        TemporaryFiles::where('folder', $tempFile->folder)->delete();
        //redirect ke halaman index foto
        return response()->redirectTo(route('public-foto.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicFoto  $publicFoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicFoto $publicFoto)
    {
        if ($publicFoto->user_id != Auth::user()->id) {
            return response()->redirectTo(route('public-foto.index'));
        }
        //delete public foto from database
        $publicFoto->delete();
        //delete file foto from storage
        if ($publicFoto->path != 'default.png') {
            Storage::disk('public')->delete(Auth::user()->id . '/' . $publicFoto->path);
            Storage::disk('public')->delete(Auth::user()->id . '/thumbnails/' . $publicFoto->path);
        }
        return redirect()->route('public-foto.index');
    }
}
