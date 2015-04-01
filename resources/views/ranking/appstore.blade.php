@extends('app')

@section('content')
<table>
@foreach($appList as $app)
    <ul>
        <li>{{ $app->ranking }}</li>
        <li>{!! HTML::link($app->url, $app->name) !!}</li>
        <li>{!! HTML::image($app->icon) !!}</li>
    </ul>
@endforeach
</table>
@stop