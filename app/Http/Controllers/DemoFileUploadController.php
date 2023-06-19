<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DemoFileUploadController extends Controller
{
    //
    public function index()
    {
        // // upload new_file.txt ke disk default
        // Storage::put('new_file.txt', 'hello world');
        // //store di disk public
        // //upload public_file.txt ke disk public
        // Storage::disk('public')->put('public_file.txt', 'hello world');
        // //store di disk surat_tugas
        // //upload surat_tugas_file.txt ke disk surat_tugas
        // Storage::disk('surat_tugas')->put('surat_tugas_file.txt', 'Suraaat Tugas');

        // $urlSuratTugas = Storage::disk('surat_tugas')->url('surat_tugas_file.txt');
        // // ddd($urlSuratTugas);

        // //download surat_tugas_file.txt
        // return Storage::disk('surat_tugas')->download('surat_tugas_file.txt');

        return response()->view('file-upload.index');
    }

    public function store(Request $request)
    {
        //upload biasa
        // $path = $request->file('file')->store('public');
        // $path = Storage::putFile('public', $request->file('file'));

        //upload rename namaa file
        // $extension = $request->file('file')->extension();
        // $name = 'dosen-ngoding';
        // $path = $request->file('file')->storeAs('public', $name . '.' . $extension);

        //upload ke custom disk
        // $path = $request->file('file')->store('surat_tugas');
        // $path = Storage::putFile('surat_tugas', $request->file('file'));
        //upload ke custom disk custom folder
        // $path = $request->file('file')->store('surat_tugas/folder_baru');
        // $path = Storage::putFile('surat_tugas/folder_baru', $request->file('file'));

        // ddd($path);
    }
}
