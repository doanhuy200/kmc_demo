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
                                        <td><a href="#previewModal" data-entry_id="{{ $entry->id }}" data-action="" class="preview-video trigger-btn" data-toggle="modal">{{ $entry->name }}</a></td>
                                        <td>{{ $entry->views }}</td>
                                        <td>{{ convertStatusVideo($entry->status) }}</td>
                                        <td>
                                            <a href="{{ route('video.edit', $entry->id) }}">Edit</a>
                                            <a href="#myModal" data-action="{{ route('video.delete', $entry->id) }}" class="delete-video trigger-btn" data-toggle="modal">Delete</a>
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
    @include('layouts.modal-delete')
    @include('video.preview')
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.delete-video').on('click', function () {
            var url = $(this).data('action');
            console.log(url);
            $('#form-delete').attr('action', url);
            $('#modal-delete').modal('show');
        });

        $('.preview-video').on('click', function () {
            var entry_id = $(this).data('entry_id');
            $.ajax({
                type:'GET',
                url:'videos/preview/' + entry_id,
                success:function(data) {
                    var dataJson = data.urlShow;
                    // var urlShow = JSON.parse(dataJson);
                    // console.log(dataJson[2].url);

                    $('.video-preview').attr('src', dataJson[2].url);
                    $('.flavor-entryId').empty();
                    $('.flavor-entryId').append("<strong>" + dataJson[2].entryId + "</strong>");
                    $('.flavor-id').empty();
                    $('.flavor-id').append("<strong>" + dataJson[2].id + "</strong>");
                    $('#video-wrapper')[0].pause();
                    $('#video-wrapper')[0].removeAttribute('src');
                    $('#video-wrapper')[0].load();
                }
            });

            // var src = $(this).data('action');
            // console.log(src);
            // $('#video-preview').attr('src', src);
            // $('#preview').modal('show');
        });
    });

</script>

