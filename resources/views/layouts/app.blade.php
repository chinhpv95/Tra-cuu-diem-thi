<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('title')

        <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    {{ Html::style('/public/assets/css/style.css') }}
    {{ Html::style('/public/assets/css/jquery-ui.css') }}
    {{ Html::script('/public/assets/js/jquery.min.js') }}
    {{ Html::script('/public/assets/js/jquery-ui.min.js') }}
    {{ Html::script('/public/assets/js/bootstrap.min.js') }}
</head>
<body id="app-layout">
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Home
            </a>
            @yield('admin')
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right custom-nav">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                            <span class="avatar">
                                @if( Auth::user()->image == null )
                                    <image src="{{ url('public/storage/images/avatar.jpg') }}" alt="avatar"/>
                                @else
                                    <image src="{{ url('public/storage/images/'. Auth::user()->image ) }}"
                                           alt="avatar"/>
                                @endif
                            </span>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('profile', ['user_id' => Auth::user()->id]) }}"><span
                                        class="glyphicon glyphicon-user"></span>Profile</a></li>
                            <li><a href="{{ url('/logout') }}"><span
                                        class="glyphicon glyphicon-log-out"></span>Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('body')
@yield('body-script')
</body>
</html>
