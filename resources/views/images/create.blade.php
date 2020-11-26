@extends('base')

@section('title')
    Resize images
@endsection

@section('content')
    <h1>Redimensionnez les images</h1>

    <form action="{{ url('/') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" name="images" class="form-control" id="exampleFormControlFile1">
        </div>
        <button type="submit" class="btn btn-outline-success">Sauvegarder</button>
    </form>
@endsection
