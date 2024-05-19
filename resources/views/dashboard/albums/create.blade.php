@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Album</h1>
    <form action="{{ route('albums.store') }}" method="POST">
        @csrf
        @include('dashboard.albums.form', ['buttonText' => 'Create'])
    </form>
</div>
@endsection
