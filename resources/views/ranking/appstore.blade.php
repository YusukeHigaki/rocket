@extends('app')

@section('content')

<table class="table table-striped">
<tr>
    <th>日付</th>
    <th>ランキング</th>
    <th>アイコン</th>
    <th>アプリ名</th>
</tr>
@foreach($appList as $app)
    <tr>
        <td>{{ $app->created_at->format('Y-m-d') }}</td>
        <td>{{ $app->ranking }}</td>
        <td>{!! HTML::image($app->icon) !!}</td>
        <td>{!! HTML::link($app->url, $app->name) !!}</td>
    </tr>
@endforeach
</table>
@stop