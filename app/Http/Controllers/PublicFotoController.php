<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicFotoRequest;
use App\Http\Requests\UpdatePublicFotoRequest;
use App\Models\PublicFoto;

class PublicFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->view('public-foto.index', [
            'public_fotos' => PublicFoto::paginate(5),
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
        //if request has foto
        if ($request->hasFile('foto')) {
            //upload file
            $request->file('foto')->store('public');
            //create new public foto
            PublicFoto::create([
                'name' => $request->name,
                'path' => $request->file('foto')->hashName(),
            ]);
        } else {
            PublicFoto::create([
                'name' => $request->name,
                'path' => 'default.png',
            ]);
        }

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
        dd("Halaman show");
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
        dd("Halaman Edit");
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
        //
        dd("Halaman Update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicFoto  $publicFoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicFoto $publicFoto)
    {
        //
        dd("Halaman destroy");
    }
}
