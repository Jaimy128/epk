@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="h1">Show Band</h2>
    <div class="card mb-4" style="background-color:{{$band->background_color}};color:{{$band->text_color}};">
        <div class="card-body p-5">
            <div class="row mb-5 bandPageHeader">
                <div class="col-md-2"><img src="{{ asset('images/'.$band->image) }}" alt="Profile picture of {{$band->name}}" class="profilePicture"></div>
                <div class="col-md-10">
                    <h1>{{$band->name}}</h1>
                </div>
            </div>


            <h4>Description</h4>
            <p class="mb-4">
                {{$band->description}}
            </p>

            <h4>Biography</h4>
            <p class="mb-4">
                {{$band->biography}}
            </p>

            @if(count($band->youtubeEmbedLinks) > 0)
            <h4>Videos</h4>
            <div class="row">
                @foreach($band->youtubeEmbedLinks as $link)
                <div class="col-md-4 youtubeVideo">
                    <iframe width="100%" height="100%" src="{{$link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</div>
@endsection