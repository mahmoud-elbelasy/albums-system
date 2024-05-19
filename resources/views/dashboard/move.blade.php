@extends('layouts.app')

@section('content')
    <h1>Move Image</h1>
    
    <form action="{{ route('images.move.update', $image->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="album_id">Select Album</label>
            <select name="album_id" id="album_id" class="form-control">
                @foreach ($albums as $album)
                    <option value="{{ $album->id }}" {{ $album->id == $image->album_id ? 'selected' : '' }}>{{ $album->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Move</button>
    </form>
@endsection
