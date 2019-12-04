@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Video Managements</div>

                    <div class="card-body">
                        <div class="form-group">
                            <a href="{{ route('video.index') }}">Back &larr;</a>
                        </div>
                        <div class="form-group">
                            <video controls>
                                <source src="{{ url($urlShow[2]['url']) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
