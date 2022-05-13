@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bands</h1>
    <div class="card mb-4">
        <div class="card-header">Bands</div>

        <div class="card-body">
            {!! Form::open(['method'=>'GET','url'=>'/bands/','class'=>'navbar-form navbar-left','role'=>'search']) !!}
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="keyword" placeholder="Search band...">
                <span class="input-group-btn">
                    <button class="btn btn-primary ms-2" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            {!! Form::close() !!}

            @if(count($bands) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Description</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bands as $band)
                    <tr>
                        <td>{{$band->id}}</td>
                        <td><a href="{{ route('bands.show', $band->id) }}">{{$band->name}}</a></td>
                        <td>{{$band->description}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-muted">No bands were found</p>
            @endif
        </div>
    </div>
</div>
@endsection