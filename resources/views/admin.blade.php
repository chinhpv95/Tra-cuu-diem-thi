@extends('layouts.wrapper')

@section('head')
    <title>Admin Dashboard</title>
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
                                <li><a href="{{ route('profile', ['user_id' => Auth::user()->id]) }}"><span
                                            class="glyphicon glyphicon-user"></span>Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
                                </li>
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

            @if(Session::has('add_message'))
                <div class="alert alert-success">
                    {{ Session::get('add_message') }}
                </div>
            @endif


            <div class="col-sm-3">
                <ul class="nav nav-tabs manager">
                    <li class="active"><a data-toggle="tab" href="#home">Cập nhật danh sách</a></li>
                    <li><a data-toggle="tab" href="#class">Cập nhật điểm</a></li>
                    @if( Auth::user()->role == 1 )
                        <li><a data-toggle="tab" href="#manager">Quản lí thành viên</a></li>
                    @endif
                    <li><a data-toggle="tab" href="#manager_year">Quản lí năm học</a></li>
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
                                    <td>{{ Form::label('school-year', 'Năm học', array('class' => 'awesome')) }}</td>
                                    <td><select name="select-year-excel">
                                            @foreach ( $years as $year )
                                                <option value="{{ $year['year_id'] }}">{{ $year['year_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                <tr>
                                    <td>{{ Form::label('semester', 'Học Kỳ', array('class' => 'awesome')) }}</td>
                                    <td>
                                        <select name="select-semester-excel">
                                            @foreach ( $semesters as $semester )
                                                <option
                                                    value="{{ $semester['semester_id'] }}">{{ $semester['semester_name'] }}</option>
                                            @endforeach
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
                                        <td>{{ Form::label( 'school-year', 'Năm học', array( 'class' => 'awesome' ) ) }}</td>
                                        <td>
                                            <select name="select-year">
                                                @foreach ( $years as $year )
                                                    <option value="{{ $year['year_id'] }}">
                                                        {{ $year['year_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ Form::label( 'semester', 'Học Kỳ', array( 'class' => 'awesome' ) ) }}</td>
                                        <td>
                                            <select name="select-semester">
                                                @foreach ( $semesters as $semester )
                                                    <option value="{{ $semester['semester_id'] }}">
                                                        {{ $semester['semester_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ Form::label( 'class', 'Tên môn học' ) }}</td>
                                        <td>{{ Form::text( 'class-name-input', '', array( 'class' => 'form-control' ) ) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ Form::label( 'class-code', 'Mã môn học' ) }}</td>
                                        <td>{{ Form::text( 'class-code-input', '', array( 'class' => 'form-control' ) ) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ Form::label( 'teacher', 'Giáo viên' ) }}</td>
                                        <td>{{ Form::text( 'teacher-input', '', array( 'class' => 'form-control' ) ) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    @if( Auth::user()->role == 1 )
                        <div id="manager" class="tab-pane fade">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tạo thành viên mới
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Tạo tài khoản</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addUser" class="form-horizontal"
                                                  action='{{ url('/admin/addUser') }}'
                                                  method="POST">
                                                <fieldset>
                                                    <div class="control-group">
                                                        <!-- Username -->
                                                        <label class="control-label">Username</label>
                                                        <div class="controls">
                                                            <input type="text" id="username" name="username"
                                                                   placeholder=""
                                                                   class="form-control" required>
                                                            <p class="help-block">Username can contain any letters
                                                                ornumbers, without spaces</p>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <!-- E-mail -->
                                                        <label class="control-label">E-mail</label>
                                                        <div class="controls">
                                                            <input type="text" id="email" name="email" placeholder=""
                                                                   class="form-control" required>
                                                            <p class="help-block">Please provide your E-mail</p>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <!-- Password-->
                                                        <label class="control-label">Password</label>
                                                        <div class="controls">
                                                            <input type="password" id="password" name="password"
                                                                   placeholder="" class="form-control">
                                                            <p class="help-block">Password should be at least
                                                                4characters</p>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <!-- Password -->
                                                        <label class="control-label">Password(Confirm)</label>
                                                        <div class="controls">
                                                            <input type="password" id="password_confirm"
                                                                   name="password_confirm" placeholder=""
                                                                   class="form-control" required>
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
                                <h3>Danh sách thành viên</h3>
                                <ul class="list-group">
                                    <li class="list-group-item"><span class="user_name">Tên Thành Viên</span>
                                        <span class="email">Email</span><span class="role">Chức vụ</span><span
                                            class="delete">Xóa</span></li>
                                    @foreach ( $users as $user )
                                        @if ( $user['role'] == 2 )
                                            <li class="list-group-item"><span
                                                    class="user_name">{{ $user['name'] }}</span>
                                                <span class="email">{{ $user['email'] }}</span>
                                                <span class="role">Cán bộ</span>
                                                <span id="{{ $user['id'] }}" data-token="{{ csrf_token() }}"
                                                      class="glyphicon glyphicon-trash delete" title="Delete"></span>
                                            </li>
                                        @else
                                            <li class="list-group-item"><span>{{ $user['name'] }}</span>
                                                <span class="email">{{ $user['email'] }}</span>
                                                <span class="role">Quản trị viên</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div id="class" class="tab-pane fade">
                        <div class="panel panel-default">
                            <div class="form-group">
                                <label>Tìm kiếm :</label>
                                <input name="keysearch" value="" placeholder="name" id="keysearch" type="text"
                                       class="form-control">
                                <span id="loading">Loading...</span>
                            </div>
                            <div id="result"></div>
                        </div>
                        <h3>Chọn năm học và kì học cần hiện thị</h3>
                        {{ Form::open(array('url' => 'admin/filter', 'method' => 'post')) }}
                        <table class="table custom-table">
                            <tbody>
                            <tr>
                                <td>{{ Form::label('school-year', 'Năm học', array('class' => 'awesome')) }}</td>
                                <td>
                                    <select name="filter-year" class="filter-year">
                                        <option value="0">Chọn trong danh sách</option>
                                        @foreach ( $years as $year )
                                            <option value="{{ $year['year_id'] }}">{{ $year['year_name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            <tr>
                                <td>{{ Form::label('semester', 'Học Kỳ', array('class' => 'awesome')) }}</td>
                                <td>
                                    <select name="filter-semester" class="filter-semester">
                                        <option value="0">Chọn trong danh sách</option>
                                        @foreach ( $semesters as $semester )
                                            <option
                                                value="{{ $semester['semester_id'] }}">{{ $semester['semester_name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span class="filter-class">Filter</span></td>
                            </tr>
                            </tbody>
                        </table>
                        {{ Form::close() }}
                        <h3>Danh sách môn học</h3>
                        <div class="send-email-success" id="send-email-success">
                        
                        </div>
                        <ul class="list-group control-group list-classes">
                            @include('partials._filter')
                        </ul>
                    </div>
                    <div id="manager_year" class="tab-pane fade">
                        <h3>Danh sách các năm học</h3>
                        {{ Form::open( array( 'url' => 'admin/multi_delete' ) ) }}
                        <ul class="list-group list-years">
                            <li class="list-group-item"><span class="year_name">Năm học</span><span class="year_modify">Chỉnh sửa</span><span
                                    class="year_delete">Xóa</span><span class="check_delete">Check</span></li>
                            @foreach ( $years as $count => $index )
                                <li class="list-group-item">
                                    <span class="year_name">{{ $count + 1 }}. {{  $index['year_name'] }}</span>
                                    <span class="year_modify glyphicon glyphicon-edit" data-toggle="modal"
                                          data-target="#year_{{ $index['year_id'] }}"></span>
                                    <span id="{{ $index['year_id'] }}"
                                          class="year_delete delete glyphicon glyphicon-trash"></span>
                                    {{ Form::checkbox( 'id_array[]', $index['year_id'] ) }}
                                </li>
                            @endforeach
                            <li class="list-group-item">
                                <span class="year_name"></span>
                                <span class="year_modify"></span>
                                <span class="year_delete delete"></span>
                                {{ Form::submit( 'Xóa' ) }}
                            </li>
                        </ul>
                        {{ Form::close() }}
                        <h3>Thêm năm học mới</h3>
                        {{ Form::open(array('url' => 'admin/addYear', 'method' => 'POST')) }}
                        <table class="table custom-table">
                            <tbody>
                            <tr>
                                <td><label class="control-label">Năm học</label></td>
                                <td><input class="form-control" id="new_year" placeholder="Nhập năm học" type="text"
                                           name="new_year"></td>
                            </tr>
                            <tr>
                                <td><label class="control-label">Mới nhất</label></td>
                                <td><input type="checkbox" id="year_active" name="year_active"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-primary" type="submit">Thêm</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        {{ Form::close() }}
                    </div>
                    @foreach( $years as $year )
                        <div class="modal fade" id="year_{{ $year['year_id'] }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Năm học</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal"
                                              action='{{ url('/admin/' . $year['year_id'] .'/updateYear') }}'
                                              method="POST">

                                            <fieldset>
                                                <div class="control-group">
                                                    <div class="controls">
                                                        <input type="text" id="year_name" name="year_name"
                                                               placeholder=""
                                                               class="form-control"
                                                               value="{{ $year['year_name'] }}">
                                                        <p class="help-block">Username can contain any letters or
                                                            numbers, without spaces</p>
                                                        <button class="btn btn-primary" role="button" type="submit">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
