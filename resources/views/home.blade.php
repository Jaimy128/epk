@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
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
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card mb-4">
                <div class="card-header">Account</div>

                <div class="card-body">
                    <a href="{{ route('change-account') }}" class="btn btn-primary me-2">Change Account Details</a>
                    <a href="{{ route('change-password') }}" class="btn btn-primary me-2">Change Password</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Your Bands</div>

                <div class="card-body">
                    <a href="{{ route('bands.create') }}" class="btn btn-primary me-2">Add New Band</a>

                    @if(count($bands) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bands as $band)
                            <tr>
                                <td>{{$band->id}}</td>
                                <td><a href="{{ route('bands.show', $band->id) }}">{{$band->name}}</a></td>
                                <td>
                                    <a href="{{ route('bands.edit',$band->id)}}" class="btn btn-primary">Edit</a>
                                    @can('delete', $band)
                                    <form action="{{ route('bands.destroy', $band->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted">No bands were found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection