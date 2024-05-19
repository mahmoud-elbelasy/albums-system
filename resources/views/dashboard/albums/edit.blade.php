@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Album</h1>
    <form action="{{ route('albums.update', $album->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('dashboard.albums.form', ['buttonText' => 'Update'])
    </form>
</div>
@endsection
