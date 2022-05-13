@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Band</h1>

    <div class="card mb-4">
        <div class="card-header">Edit Band</div>

        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger mb-2">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="post" action="{{ route('bands.update', $band->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="form-group my-2">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $band->name }}" />
                </div>

                <div class="form-group my-2">
                    <label for="description">Description:</label>
                    <textarea name="description" cols="30" rows="3" class="form-control">{{ $band->description }}</textarea>
                </div>

                <div class="form-group my-2">
                    <label for="biography">Biography:</label>
                    <textarea name="biography" cols="30" rows="10" class="form-control">{{ $band->biography }}</textarea>
                </div>

                <div class="form-group my-2">
                    <label for="image">New Profile Picture <small>(old one will be <strong>deleted</strong> if new one is uploaded!)</small>:</label>
                    <input type="file" class="form-control" name="image" accept="image/png, image/jpeg" />
                </div>

                <div class="form-group my-2">
                    <label for="background_color">Background Color:</label>
                    <div>
                        <input type="color" name="background_color" value="{{ $band->background_color }}" style="border:0;" />
                    </div>
                </div>

                <div class="form-group my-2">
                    <label for="text_color">Text Color:</label>
                    <div>
                        <input type="color" name="text_color" value="{{ $band->text_color }}" style="border:0;" />
                    </div>
                </div>

                <div class="form-group my-2">
                    <label for="youtube_1">Youtube link #1:</label>
                    <input type="url" class="form-control" name="youtube_1" value="{{ $band->youtube_1 }}" />
                </div>

                <div class="form-group my-2">
                    <label for="youtube_2">Youtube link #2:</label>
                    <input type="url" class="form-control" name="youtube_2" value="{{ $band->youtube_2 }}" />
                </div>

                <div class="form-group my-2">
                    <label for="youtube_3">Youtube link #3:</label>
                    <input type="url" class="form-control" name="youtube_3" value="{{ $band->youtube_3 }}" />
                </div>

                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection