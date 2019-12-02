@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Video</div>

                    <div class="card-body">
                        <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Upload video</label>
                                <input type="file" class="form-control" name="file" placeholder="Video upload">
                                <small id="emailHelp" class="form-text text-muted">Upload file video to create entry.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
