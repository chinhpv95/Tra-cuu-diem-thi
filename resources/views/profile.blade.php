@extends('layouts.wrapper')

@section('head')
    <title>Admin Dashboard</title>
@endsection

@section('head.style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css"/>
@endsection

@section('body')
    <div class="container">
        <div class="row">
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
                        <a class="navbar-brand" href="{{ url('/admin') }}">Admin</a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Register</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                    <?php $user_id = Auth::user()->id; ?>
                                        <li><a href="{{ url('/logout') }}"><span
                                                    class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                                        <li><a href="{{ route('profile', ['user_id' => $user_id]) }}"><span
                                                    class="glyphicon glyphicon-user"></span>Profile</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <ul class="list-group show_profile">
                <li class="list-group-item"><span>Name</span>
                    <span class="name"><?php echo $data['name']; ?></span>
                    <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#name"></span>
                </li>
                <li class="list-group-item">
                    <span>Email</span>
                    <span class="email"><?php echo $data['email']; ?></span>
                    <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#email"></span>
                </li>
                <li class="list-group-item">
                    <span>Password</span>
                    <span class="password">Password never changed</span>
                    <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#password"></span>
                </li>
            </ul>

            <!-- Modal -->
            <div class="modal fade" id="name" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Name</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action='{{ url('/profile/' . $data['id'] . '/updateName') }}'
                                  method="POST">

                                <fieldset>
                                    <div class="control-group">
                                        <!-- Username -->
                                        <label class="control-label" for="username">Username</label>
                                        <div class="controls">
                                            <input type="text" id="username" name="username" placeholder=""
                                                   class="form-control" value="<?php echo $data['name']; ?>">
                                            <p class="help-block">Username can contain any letters or
                                                numbers, without spaces</p>
                                            <button class="btn btn-primary" role="button" type="submit">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Email</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action='{{ url('/profile/' . $data['id'] . '/updateEmail') }}'
                                  method="POST">

                                <fieldset>
                                    <div class="control-group">
                                        <!-- Username -->
                                        <label class="control-label" for="email">Email</label>
                                        <div class="controls">
                                            <input type="text" id="email" name="email" placeholder=""
                                                   class="form-control" value="<?php echo $data['email']; ?>">
                                            <p class="help-block">Please provide your E-mail</p>
                                            <button class="btn btn-primary" role="button" type="submit">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Password</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action='{{ url('/profile/' . $data['id'] . '/updatePassword') }}'
                                  method="POST">

                                <fieldset>
                                    <div class="control-group">
                                        <!-- Username -->
                                        <label class="control-label" for="password">Password</label>
                                        <div class="controls">
                                            <input type="password" id="username" name="password" placeholder=""
                                                   class="form-control" value="<?php echo $data['password']; ?>">
                                            <p class="help-block">Password should be at least 4
                                                characters</p>
                                            <button class="btn btn-primary" role="button" type="submit">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(Session::has('updateName_message'))
                <div class="alert alert-success">
                    {{ Session::get('update_message') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('body.script')
    {{ Html::script('assets/js/jquery.min.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/bootstrap.min.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/main.js', array('async' => 'async')) }}
@endsection