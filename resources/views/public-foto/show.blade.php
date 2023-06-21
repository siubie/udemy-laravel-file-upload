@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Homepage</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Demo Public File Upload</h2>
            <p class="section-lead">Show Uploaded File</p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Empty Data</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <img src="{{ asset('storage/' . $publicFoto->path) }}" alt="image" />
                                <h2>{{ $publicFoto->name }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('sidebar')
    @parent
@endsection
