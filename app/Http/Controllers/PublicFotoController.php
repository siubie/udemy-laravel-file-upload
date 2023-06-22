<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicFotoRequest;
use App\Http\Requests\UpdatePublicFotoRequest;
use App\Models\PublicFoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        //upload file
        $request->file('foto')->store('public');
        //create new public foto
        PublicFoto::create([
            'name' => $request->name,
            'path' => $request->file('foto')->hashName(),
        ]);
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
        //simpen foto yang lama
        $oldFoto = $publicFoto->path;
        //upload file ke public storage
        $request->file('foto')->store('public');
        //update data public foto di database
        $publicFoto->update([
            'name' => $request->name,
            'path' => $request->file('foto')->hashName(),
        ]);
        //hapus file foto yang lama
        Storage::disk('public')->delete($oldFoto);
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
        //delete public foto from database
        $publicFoto->delete();
        //delete file foto from storage
        Storage::disk('public')->delete($publicFoto->path);
        return redirect()->route('public-foto.index');
    }
}
