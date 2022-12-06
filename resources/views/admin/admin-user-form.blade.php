@extends('layouts.master')
@section('content')
<style>
</style>
<div id="app">
    <div class="col-lg-7 col-md-6 col-sm-12">
        <h2>New Admin Users</h2>

        <form action="{{ route('store.admin') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <input type="text" placeholder="Name" id="name" class="form-control" name="name" required autofocus>
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group mb-3">
                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required>
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group mb-3">
                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-info btn-block">Save</button>
            </div>
        </form>

    </div>
</div>

@endsection


@section('script')
@endsection