@extends('layouts.app')

@section('content')
<div class="container ">
    <h1>Albums</h1>
    <div class="mx-auto p-2">
        <a href="{{ route('albums.create') }}" class="btn btn-primary ">Create New Album</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($albums as $album)
                <tr>
                    <td>{{ $album->name }}</td>
                  
                    <td>
                        <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('albums.upload', $album->id) }}" class="btn btn-secondary">Upload Images</a>
                        <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning">Edit</a>
                        
                        <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirmDelete(event, {{ $album->images->count() }})">Delete</button>
                        </form>
                        <form action="{{ route('albums.delete-images', ['albumId' => $album->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete all images in this album?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete All Images in Album</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(event, imageCount) {
        if (imageCount > 0) {
            var result = confirm("Are you sure you want to delete this non-empty album? This action will delete the photos as well.");
            if (!result) {
                event.preventDefault();
            }
            return result;
        }
        return true;
    }
</script>
@endsection


 