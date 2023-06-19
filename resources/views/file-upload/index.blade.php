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
                        <div class="card-body">
                            <div class="clearfix mb-3"></div>
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
