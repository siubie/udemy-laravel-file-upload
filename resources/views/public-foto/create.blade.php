@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Homepage</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Demo Public File Upload</h2>
            <p class="section-lead">Create New File</p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create New File</h4>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('public-foto.store') }}">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Nama Hewan</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Pilih Foto</label>
                                    <input type="file" name="foto"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('foto') }}">
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('sidebar')
    @parent
@endsection