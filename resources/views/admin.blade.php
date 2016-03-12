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
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            Home
                        </a>
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>


            @if(Session::has('flash_message'))
            <div class="alert alert-success">
            {{ Session::get('flash_message') }}
            </div>
            @endif


            <?php if( Auth::user()->role != 2 ) { ?>
            <div class="col-sm-3">
                <ul class="nav nav-tabs manager">
                    <li class="active"><a data-toggle="tab" href="#home">Cập nhật danh sách</a></li>
                    <?php if( Auth::user()->role == 0 ) { ?>
                    <li><a data-toggle="tab" href="#manager">Quản lý</a></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-sm-9">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="upload-file">
                            <p>Chọn file excel để import vào cơ sở dữ liệu</p>
                            <?php
                            echo Form::open(array('url' => 'admin/getExcel', 'method' => 'POST', 'files' => true));
                            echo '<td>' . Form::label('year', 'Năm học:') . '</td>';
                            echo '<td>' . Form::text('year-input-excel') . '</td>';
                            echo '<td>' . Form::label('semester', 'Học kì:') . '</td>';
                            echo '<td>' . Form::select('semester-input-excel', array(
                                    'hoc_ky_1' => 'Học kỳ I',
                                    'hoc_ky_phu_1' => 'Học kỳ phụ I',
                                    'hoc_ky_2' => 'Học kỳ II',
                                    'hoc_ky_phu_2' => 'Học kỳ phụ II',
                                    'hoc_ky_he' => 'Học kỳ hè'
                                )) . '</td>';
                            echo Form::file('xls');
                            echo '<button class="btn btn-primary" type="submit">Import</button>';
                            echo Form::close();
                            ?>
                        </div>
                        <form action="{{ route('getClass') }}" data-toggle="validator" method="POST">
                            <table class="table custom-table">
                                <tbody>
                                <tr>
                                    <?php
                                    echo '<td>' . Form::label('year', 'Năm học:') . '</td>';
                                    echo '<td>' . Form::text('year-input') . '</td>';
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    echo '<td>' . Form::label('semester', 'Học kì:') . '</td>';
                                    echo '<td>' . Form::select('semester-input', array(
                                            'hoc_ky_1' => 'Học kỳ I',
                                            'hoc_ky_phu_1' => 'Học kỳ phụ I',
                                            'hoc_ky_2' => 'Học kỳ II',
                                            'hoc_ky_phu_2' => 'Học kỳ phụ II',
                                            'hoc_ky_he' => 'Học kỳ hè'
                                        )) . '</td>';
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    echo '<td>' . Form::label('class', 'Tên môn học') . '</td>';
                                    echo '<td>' . Form::text('class-name-input') . '</td>';
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    echo '<td>' . Form::label('class-code', 'Mã môn học') . '</td>';
                                    echo '<td>' . Form::text('class-code-input') . '</td>';
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    echo '<td>' . Form::label('teacher', 'Giáo viên') . '</td>';
                                    echo '<td>' . Form::text('teacher-input') . '</td>';
                                    ?>
                                </tr>

                                <tr>

                                    <?php

                                    echo '<td></td><td><a class="btn btn-primary" href= "admin/getClass" role="button" type="submit">Submit</a></td>';
                                    ?>
                                </tr>

                                </tbody>
                            </table>
                        </form>
                    </div>
                    <?php if( Auth::user()->role == 0 ) { ?>
                    <div id="manager" class="tab-pane fade">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Tạo thành viên mới
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Tạo tài khoản</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" action='{{ url('/admin/addUser') }}'
                                              method="POST">

                                            <fieldset>
                                                <div class="control-group">
                                                    <!-- Username -->
                                                    <label class="control-label" for="username">Username</label>
                                                    <div class="controls">
                                                        <input type="text" id="username" name="username" placeholder=""
                                                               class="form-control">
                                                        <p class="help-block">Username can contain any letters or
                                                            numbers, without spaces</p>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <!-- E-mail -->
                                                    <label class="control-label" for="email">E-mail</label>
                                                    <div class="controls">
                                                        <input type="text" id="email" name="email" placeholder=""
                                                               class="form-control">
                                                        <p class="help-block">Please provide your E-mail</p>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <!-- Password-->
                                                    <label class="control-label" for="password">Password</label>
                                                    <div class="controls">
                                                        <input type="password" id="password" name="password"
                                                               placeholder="" class="form-control">
                                                        <p class="help-block">Password should be at least 4
                                                            characters</p>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <!-- Password -->
                                                    <label class="control-label" for="password_confirm">Password
                                                        (Confirm)</label>
                                                    <div class="controls">
                                                        <input type="password" id="password_confirm"
                                                               name="password_confirm" placeholder=""
                                                               class="form-control">
                                                        <p class="help-block">Please confirm password</p>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <div class="controls">
                                                        <label class="radio-inline"><input type="radio" name="role"
                                                                                           value="1">Quản trị</label>
                                                        <label class="radio-inline"><input type="radio" name="role"
                                                                                           value="0">Giáo viên</label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <!-- Button -->
                                                    <div class="controls">
                                                        <button class="btn btn-success">Register</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-user">
                            <ul class="list-group">
                                <?php
                                $users = App\User::where('role', '=', '1')->orwhere('role', '=', '2')->get();
                                foreach( $users as $user ) {
                                    echo '<li class="list-group-item">' . $user['name'] . '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } else {
            $teacher_class = App\Classes::where('user_id', '=', Auth::user()->id)->get();
            echo '<ul class="list-group control-group list-classes">';
                foreach( $teacher_class as $index ) {
                    echo '<li class="list-group-item"><span>' . $index['class_name'] . ' (' . $index['class_code'] . ')</span>';
                    $url = route('upLoad', ['class_id' => $index['class_id']] );
                    echo $url;
                     echo Form::open(array('url'=> $url ,'method'=>'POST', 'files'=>true));
                                echo Form::file('link'); 
                                echo Form::submit('Upload');
                                echo Form::close();
                }
                
            echo '</ul>';
            } ?>

        </div>
    </div>
@endsection

@section('body.script')
    {{ Html::script('assets/js/jquery.min.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/bootstrap.min.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/main.js', array('async' => 'async')) }}
@endsection