@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Video Managements</div>

                    <div class="card-body">
                        <a href="{{ route('video.create') }}">Create</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ThumbnailUrl</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Views</th>
                                    <th scope="col">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($entries as $entry)
                                    <tr>
                                        <th scope="row">{{ $entry->id }}</th>
                                        <td><img src="{{ $entry->thumbnailUrl }}" class="imgThumbs"/></td>
                                        <td><a href="{{ url("view/360/$entry->partnerId/$entry->id") }}" target="_blank">{{ $entry->name }}</a></td>
                                        <td>{{ $entry->views }}</td>
                                        <td>{{ $entry->status }}</td>
                                        <td>
                                            <a href="{{ route('video.edit', $entry->id) }}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
