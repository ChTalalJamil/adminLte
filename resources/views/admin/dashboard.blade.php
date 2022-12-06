@extends('layouts.master')
@section('content')
<style>
</style>
<div id="app">
    <h2>Hello {{Auth::user()->name}} </h2>
</div>
@endsection