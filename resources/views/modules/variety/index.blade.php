@extends('variety::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('variety.name') !!}
    </p>
@stop
