@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Homepage</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Demo File Upload</h2>
            <p class="section-lead">Manage File Data</p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Files</h4>

                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('fileupload.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Pilih File</label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Text</label>
                                    <input type="text" class="form-control" name="text">
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
