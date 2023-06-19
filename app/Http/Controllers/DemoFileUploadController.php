<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DemoFileUploadController extends Controller
{
    //
    public function index()
    {
        // upload new_file.txt ke disk default
        Storage::put('new_file.txt', 'hello world');
        //store di disk public
        //upload public_file.txt ke disk public
        Storage::disk('public')->put('public_file.txt', 'hello world');
        //store di disk surat_tugas
        //upload surat_tugas_file.txt ke disk surat_tugas
        Storage::disk('surat_tugas')->put('surat_tugas_file.txt', 'Suraaat Tugas');

        $urlSuratTugas = Storage::disk('surat_tugas')->url('surat_tugas_file.txt');
        // ddd($urlSuratTugas);

        //download surat_tugas_file.txt
        return Storage::disk('surat_tugas')->download('surat_tugas_file.txt');
    }
}
