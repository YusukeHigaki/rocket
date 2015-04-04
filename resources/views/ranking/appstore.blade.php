@extends('app')

@section('content')

<table class="table table-striped">
<tr>
    <th>ランキング</th>
    <th>アイコン</th>
    <th>アプリ名</th>
</tr>

<?php $date = null; ?>
@foreach($appList as $app)
    @if($date != $app->created_at->format('Y-m-d'))
    <tr class="info">
        <td colspan="3"><b>{{ $app->created_at->format('Y-m-d') }}</b></td>
    </tr>
    <?php $date = $app->created_at->format('Y-m-d'); ?>
    @endif

    <tr>
        <td valign="middle">{{ $app->ranking }}</td>
        <td>{!! HTML::image($app->icon) !!}</td>
        <td>{!! HTML::link($app->url, $app->name) !!}</td>
    </tr>
@endforeach
</table>
@stop