@extends('layouts.app')

@section('content')
    <style> 
        .image-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Adjust the number of columns as needed */
            grid-gap: 20px;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 10px;
        }

        .actions button, .actions a {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

    <h1>{{ $album->name }}</h1>

    <div class="image-grid">
        @foreach ($images as $image)
            <div class="image-container">
                <img src="{{ asset($image->path) }}" alt="{{ $image->name }}" title="{{ $image->name }}" loading="lazy">
                <div class="actions">
                    <form action="{{ route('images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    <a href="{{ route('images.move', $image->id) }}">Move</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container mt-4">
        <a href="{{ route('albums.index') }}" class="btn btn-primary back-button">Back to List</a>
    </div>
@endsection

