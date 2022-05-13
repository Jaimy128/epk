@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Band</h1>

    <div class="card mb-4">
        <div class="card-header">Create New Band</div>

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

            <form method="post" action="{{ route('bands.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group my-2">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                </div>

                <div class="form-group my-2">
                    <label for="description">Description:</label>
                    <textarea name="description" cols="30" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="form-group my-2">
                    <label for="biography">Biography:</label>
                    <textarea name="biography" cols="30" rows="10" class="form-control">{{ old('biography') }}</textarea>
                </div>

                <div class="form-group my-2">
                    <label for="image">Profile Picture:</label>
                    <input type="file" class="form-control" name="image" accept="image/png, image/jpeg" />
                </div>

                <div class="form-group my-2">
                    <label for="background_color">Background Color:</label>
                    <div>
                        <input type="color" name="background_color" value="{{ old('background_color', '#ffffff') }}" style="border:0;"/>
                    </div>
                </div>

                <div class="form-group my-2">
                    <label for="text_color">Text Color:</label>
                    <div>
                        <input type="color" name="text_color" value="{{ old('text_color', '#000000') }}" style="border:0;"/>
                    </div>
                </div>

                <div class="form-group my-2">
                    <label for="youtube_1">Youtube link #1:</label>
                    <input type="url" class="form-control" name="youtube_1" value="{{ old('youtube_1') }}" />
                </div>

                <div class="form-group my-2">
                    <label for="youtube_2">Youtube link #2:</label>
                    <input type="url" class="form-control" name="youtube_2" value="{{ old('youtube_2') }}" />
                </div>

                <div class="form-group my-2">
                    <label for="youtube_3">Youtube link #3:</label>
                    <input type="url" class="form-control" name="youtube_3" value="{{ old('youtube_3') }}" />
                </div>

                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection