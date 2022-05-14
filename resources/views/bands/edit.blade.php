@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Band</h1>

    @if ($errors->any())
    <div class="alert alert-danger mb-2">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @can('viewModerators', $band)
    <div class="card mb-4">
        <div class="card-header">Active Moderators</div>

        <div class="card-body">
            @if(count($band->moderators) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($band->moderators as $mod)
                    <tr>
                        <td>{{$mod->id}}</td>
                        <td>{{$mod->name}}</td>
                        <td>{{$mod->email}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-muted">No moderators were found</p>
            @endif
        </div>
    </div>
    @endcan

    @can('toggleModerators', $band)
    <div class="card mb-4">
        <div class="card-header">Add / Remove Moderators</div>

        <div class="card-body">
            <form method="post" action="{{ route('bands.toggleModerator', $band->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group my-2">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" />
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div>
    @endcan


    <div class="card mb-4">
        <div class="card-header">Edit Band</div>

        <div class="card-body">
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