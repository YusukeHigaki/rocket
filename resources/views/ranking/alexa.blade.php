@extends('app')

@section('content')

    <table class="table table-striped">
        <tr>
            <th>ランキング</th>
            <th>URL</th>
            <th>説明</th>
        </tr>

        <?php $date = null; ?>
        @foreach($webList as $web)
            @if($date != $web->created_at->format('Y-m-d'))
                <tr class="info">
                    <td colspan="3"><b>{{ $web->created_at->format('Y-m-d') }}</b></td>
                </tr>
                <?php $date = $web->created_at->format('Y-m-d'); ?>
            @endif

            <tr>
                <td valign="middle">{{ $web->ranking }}</td>
                <td>{!! HTML::link($web->url, $web->url) !!}</td>
                <td>{{ $web->description }}</td>
            </tr>
        @endforeach
    </table>
@stop