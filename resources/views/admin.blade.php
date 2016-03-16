@extends('layouts.wrapper')

@section('head')
    <title>Admin Dashboard</title>
@endsection

@section('head.style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css"/>
@endsection

@section('body')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                                <li><a href="{{ route('profile', ['user_id' => $user_id]) }}"><span
                                            class="glyphicon glyphicon-user"></span>Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><span
                                            class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif

            @if(Session::has('delete_message'))
                <div class="alert alert-success">
                    {{ Session::get('delete_message') }}
                </div>
            @endif


            <div class="col-sm-3">
                <ul class="nav nav-tabs manager">
                    <li class="active"><a data-toggle="tab" href="#home">Cập nhật danh sách</a></li>
                    <li><a data-toggle="tab" href="#class">Cập nhật điểm</a></li>
                    <?php if( Auth::user()->role == 1 ) { ?>
                    <li><a data-toggle="tab" href="#manager">Quản lí thành viên</a></li>
                    <?php } ?>

                </ul>
            </div>

            <div class="col-sm-9">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="upload-file">
                            <h3>Import file Excel</h3>
                            {{ Form::open(array('url' => 'admin/getExcel', 'method' => 'POST', 'files' => true)) }}
                            <table class="table custom-table">
                                <tbody>
                                <tr>
                                    <?php
                                    $years = App\Year::select('year_id', 'year_name')->get();
                                    $semesters = App\Semester::select('semester_id', 'semester_name')->get();
                                    ?>
                                    <td>{{ Form::label('school-year', 'Năm học', array('class' => 'awesome')) }}</td>
                                    <td><select name="select-year-excel">
                                            <?php
                                            foreach ($years as $year) {
                                                echo '<option value="' . $year['year_id'] . '">' . $year['year_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                <tr>
                                    <td>{{ Form::label('semester', 'Học Kỳ', array('class' => 'awesome')) }}</td>
                                    <td>
                                        <select name="select-semester-excel">
                                            <?php
                                            foreach ($semesters as $semester) {
                                                echo '<option value="' . $semester['semester_id'] . '">' . $semester['semester_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ Form::label('semester', 'File Upload', array('class' => 'awesome')) }}</td>
                                    <td>{{ Form::file('xls') }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-primary" type="submit">Import</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            {{ Form::close() }}
                        </div>
                        <div class="upload-manual">
                            <h3>Thêm lớp môn học</h3>
                            <form action="{{ route('getClass') }}" data-toggle="validator" method="POST">
                                {!! csrf_field() !!}
                                <table class="table custom-table">
                                    <tbody>
                                    <tr>
                                        <?php
                                        echo '<td>' . Form::label('school-year', 'Năm học', array('class' => 'awesome')) . '</td>';
                                        echo '<td><select name="select-year">';
                                        foreach ($years as $year) {
                                            echo '<option value="' . $year['year_id'] . '">' . $year['year_name'] . '</option>';
                                        }
                                        echo '</select></td>';
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        echo '<td>' . Form::label('semester', 'Học Kỳ', array('class' => 'awesome')) . '</td>';
                                        echo '<td><select name="select-semester">';
                                        foreach ($semesters as $semester) {
                                            echo '<option value="' . $semester['semester_id'] . '">' . $semester['semester_name'] . '</option>';
                                        }
                                        echo '</select></td>';
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        echo '<td>' . Form::label('class', 'Tên môn học') . '</td>';
                                        echo '<td>' . Form::text('class-name-input', '', array('class' => 'form-control')) . '</td>';
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        echo '<td>' . Form::label('class-code', 'Mã môn học') . '</td>';
                                        echo '<td>' . Form::text('class-code-input', '', array('class' => 'form-control')) . '</td>';
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        echo '<td>' . Form::label('teacher', 'Giáo viên') . '</td>';
                                        echo '<td>' . Form::text('teacher-input', '', array('class' => 'form-control')) . '</td>';
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                        echo '<td></td><td><button class="btn btn-primary" role="button" type="submit">Submit</button></td>';
                                        ?>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <?php if( Auth::user()->role == 1 ) { ?>
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
                                                                                           value="1">Quản trị
                                                            viên</label>
                                                        <label class="radio-inline"><input type="radio" name="role"
                                                                                           value="2">Cán bộ</label>
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
                                foreach ($users as $user) {
                                    echo '<li class="list-group-item"><span>' . $user['name'] . '</span>';
                                    echo '<button type="submit" class="action"><a href="#" id="' . $user['id'] . '" data-token="{{ csrf_token() }}" class="delete" title="Delete">X</a></button>';
                                    echo '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>

                    <div id="class" class="tab-pane fade">
                        <?php
                        $teacher_class = App\Classes::get();
                        echo '<h3>Danh sách môn học</h3>';
                        echo '<ul class="list-group control-group list-classes">';
                        foreach ($teacher_class as $value => $index) {
                            $value++;
                            if (!isset($index['link'])) {
                                echo '<li class="list-group-item"><span>' . $index['class_name'] . ' (' . $index['class_code'] . ')</span>';
                                $urlUpload = route('upLoad', ['class_id' => $index['class_id']]);

                                echo Form::open(array('url' => $urlUpload, 'method' => 'POST', 'files' => true));
                                echo Form::file('link');
                                echo Form::submit('Upload', array('class' => 'btn btn-primary'));
                                echo Form::close();

                                $urlDownload = route('downLoad', ['class_id' => $index['class_id']]);
                                echo Form::open(array('url' => $urlDownload, 'method' => 'POST', 'files' => true));
                                echo Form::submit('Download', array('class' => 'btn btn-primary'));
                                echo Form::close();
                                echo '</li>';
                            } else {
                                echo '<li class="list-group-item">';
                                echo '<a href="' . url('storage') . '/' . $index["link"] . '" target="_blank">
                                    <span>' . $index['class_name'] . ' (' . $index['class_code'] . ')</span>
                                    </a>';
                                $urlUpload = route('upLoad', ['class_id' => $index['class_id']]);

                                echo Form::open(array('url' => $urlUpload, 'method' => 'POST', 'files' => true));
                                echo Form::file('link');
                                echo Form::submit('Upload', array('class' => 'btn btn-primary'));
                                echo Form::close();

                                $urlDownload = route('downLoad', ['class_id' => $index['class_id']]);
                                echo Form::open(array('url' => $urlDownload, 'method' => 'POST', 'files' => true));
                                echo Form::submit('Download', array('class' => 'btn btn-primary'));
                                echo Form::close();
                                echo '<span class="glyphicon glyphicon-ok"></span></li>';
                            }
                        }

                        echo '</ul>';
                        ?>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

@section('body.script')
    {{ Html::script('assets/js/jquery.min.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/bootstrap.min.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/main.js', array('async' => 'async')) }}
@endsection
