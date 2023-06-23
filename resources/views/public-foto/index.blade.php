@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>File Management</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">File List</h2>
            <p class="section-lead">Manage File data</p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All File</h4>
                            <div class="card-header-action">
                                <a href="{{ route('public-foto.create') }}" class="btn btn-lg btn-primary">Create New
                                    File</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Foto</th>
                                    </tr>
                                    @foreach ($public_fotos as $index => $item)
                                        <tr>
                                            <td>
                                                {{ $index + $public_fotos->firstItem() }}
                                            </td>
                                            <td> {{ $item->name }}
                                                <div class="table-links">
                                                    <a href="{{ route('public-foto.show', $item->id) }}">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="{{ route('public-foto.edit', $item->id) }}">Edit</a>
                                                    <div class="bullet"></div>
                                                    <form action="{{ route('public-foto.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-icon">
                                                            Trash
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item->path == 'default.png')
                                                    <img src="{{ asset('storage/' . $item->path) }}"
                                                        alt="{{ $item->name }}">
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->id . '/thumbnails/' . $item->path) }}"
                                                        alt="{{ $item->name }}">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        {{ $public_fotos->withQueryString()->links() }}
                                    </ul>
                                </nav>
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
    <li class="menu-header">Starter</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
            <span>Layout</span></a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="layout-default.html">Default Layout</a>
            </li>
            <li>
                <a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a>
            </li>
            <li>
                <a class="nav-link" href="layout-top-navigation.html">Top Navigation</a>
            </li>
        </ul>
    </li>
@endsection
