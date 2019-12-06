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
                                @if (isset($urlShow[2]))
                                    <source src="{{ url($urlShow[2]['url']) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                @elseif (isset($urlShow[3]))
                                    <source src="{{ url($urlShow[3]['url']) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                @elseif (isset($urlShow[4]))
                                    <source src="{{ url($urlShow[4]['url']) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                @elseif (isset($urlShow[5]))
                                    <source src="{{ url($urlShow[5]['url']) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                @elseif (isset($urlShow[6]))
                                    <source src="{{ url($urlShow[6]['url']) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                @elseif (isset($urlShow[7]))
                                    <source src="{{ url($urlShow[7]['url']) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                @else
                                    Not video format .mp4.
                                @endif
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
