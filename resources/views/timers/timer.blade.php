@extends('layouts.app')

@section('content')
    <div id="app">
        <timer-component :timer='@json($timer)'></timer-component>
    </div>
@endsection