@extends('photograph::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('photograph.name') !!}
    </p>
@stop
