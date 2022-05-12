@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="display-6">Dashboard</h1>
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card mb-4">
                <div class="card-header">Account</div>

                <div class="card-body">
                    <a href="{{ route('change-account') }}" class="btn btn-primary me-2">Change Account Details</a>
                    <a href="{{ route('change-password') }}" class="btn btn-primary me-2">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection