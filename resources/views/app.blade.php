<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
<title>Ranking</title>
</head>

<body>
<div class="container-fluid">
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Rocket</a>
    </div>
    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ranking <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('appstore') }}">appstore</a></li>
                <li><a href="{{ route('googleplay') }}">google play</a></li>
                <li><a href="{{ route('alexa') }}">alexa</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div class="content">
@yield('content')
</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>