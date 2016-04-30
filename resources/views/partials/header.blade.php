<!DOCTYPE html>
<html lang="vi">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}}" />
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    @yield('head')
    {{ Html::style('/public/assets/css/style.css') }}
    {{ Html::style('/public/assets/css/jquery-ui.css') }}
    {{ Html::script('/public/assets/js/jquery.min.js') }}
    {{ Html::script('/public/assets/js/jquery-ui.min.js') }}
    {{ Html::script('/public/assets/js/bootstrap.min.js') }}
</head>

<body>