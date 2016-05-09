@extends('layouts.app')

@section('title')
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

            @if(Session::has('multi_delete'))
                <div class="alert alert-success">
                    {{ Session::get('multi_delete') }}
                </div>
            @endif

            @if(Session::has('update_permission'))
                <div class="alert alert-success">
                    {{ Session::get('update_permission') }}
                </div>
            @endif

            <div class="col-sm-3">
                <ul class="nav nav-tabs manager">
                    @if( App\User::find(Auth::user()->id)->hasRole($user_role, '1') ||  App\User::find(Auth::user()->id)->isAdmin() )
                        <li class="active"><a data-toggle="tab" href="#home">Cập nhật danh sách</a></li>
                    @endif
                    @if( App\User::find(Auth::user()->id)->hasRole($user_role, '2') ||  App\User::find(Auth::user()->id)->isAdmin() )
                        <li><a data-toggle="tab" href="#class">Cập nhật điểm</a></li>
                    @endif
                    @if( App\User::find(Auth::user()->id)->hasRole($user_role, '3') ||  App\User::find(Auth::user()->id)->isAdmin() )
                        <li><a data-toggle="tab" href="#manager">Quản lí thành viên</a></li>
                    @endif
                    @if( App\User::find(Auth::user()->id)->hasRole($user_role, '4') ||  App\User::find(Auth::user()->id)->isAdmin() )
                        <li><a data-toggle="tab" href="#manager_year">Quản lí năm học</a></li>
                    @endif
                    @if( App\User::find(Auth::user()->id)->isAdmin() )
                        <li><a data-toggle="tab" href="#manager_permission">Quản lí vai trò</a></li>
                    @endif
                </ul>
            </div>

            <div class="col-sm-9">
                <div class="tab-content">
                    @if( App\User::find(Auth::user()->id)->hasRole($user_role, '1') ||  App\User::find(Auth::user()->id)->isAdmin() )
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
                                                    <option
                                                        value="{{ $year['year_id'] }}">{{ $year['year_name'] }}</option>
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
                                        <td><span
                                                class="btn-file btn btn-primary">Select File{{ Form::file('xls') }}</span>
                                        </td>
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
                                        tr>
                                            <td>{{ Form::label( 'email', 'Email của giáo viên' ) }}</td>
                                            <td>{{ Form::text( 'email-input', '', array( 'class' => 'form-control' ) ) }}</td>
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
                    @endif
                    @if( App\User::find(Auth::user()->id)->hasRole($user_role, '3') ||  App\User::find(Auth::user()->id)->isAdmin() )
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
                                                        <label class="control-label">Permission</label>
                                                        <div class="controls">
                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                                                  name="role[]"
                                                                                                  value="1">Cập nhật
                                                                danh sách</label>
                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                                                  name="role[]"
                                                                                                  value="2">Cập nhật
                                                                điểm</label>
                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                                                  name="role[]"
                                                                                                  value="3">Quản lí
                                                                thành viên</label>
                                                            <label class="checkbox-inline"><input type="checkbox"
                                                                                                  name="role[]"
                                                                                                  value="4">Quản lí năm
                                                                học</label>
                                                        </div>
                                                    </div>
                                                    @if( App\User::find(Auth::user()->id)->isAdmin() )
                                                        <div class="control-group">
                                                            <label class="control-label">Admin</label>
                                                            <div class="controls">
                                                                <label class="checkbox-inline"><input type="checkbox"
                                                                                                      name="isAdmin"
                                                                                                      value="1">Admin</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="control-group">
                                                        <!-- Button -->
                                                        <label class="control-label"></label>
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
                                    <li class="list-group-item admin"><span class="user_name">Tên Thành Viên</span>
                                        <span class="email">Email</span><span
                                            class="delete">Xóa</span></li>
                                    @foreach ( $users as $user )
                                        @if ( $user['is_admin'] != 1 )
                                            <li class="list-group-item">
                                                <input type="checkbox" class="check-box-user" form="form-delete"
                                                       name="id_array[]" value="{{$user['id']}}"/>
                                                <span
                                                    class="user_name">{{ $user['name'] }}</span>
                                                <span class="email">{{ $user['email'] }}</span>
                                                <span id="{{ $user['id'] }}" data-token="{{ csrf_token() }}"
                                                      class="glyphicon glyphicon-trash delete" title="Delete"></span>
                                            </li>
                                        @else
                                            <li class="list-group-item admin">

                                                <span>{{ $user['name'] }}</span>
                                                <span class="email">{{ $user['email'] }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                {{ Form::open( array( 'url' => 'admin/multi_delete_user', 'id'=>'form-delete' ) ) }}
                                <label><input type="checkbox" class="checkAllUser"/> Check all</label>
                                {{ Form::submit( 'Xóa', array('class' => 'btn btn-primary') ) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    @endif

                    @if( App\User::find(Auth::user()->id)->hasRole($user_role, '2') ||  App\User::find(Auth::user()->id)->isAdmin() )
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
                            {{ Form::open(array('url' => 'admin/filter_class', 'method' => 'post')) }}
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
                            {{ Form::open( array( 'url' => 'admin/multi_delete_pdf', 'id'=>'form-delete-class' ) ) }}
                            <label><input type="checkbox" class="checkAllClass"/> Check all</label>
                            {{ Form::submit( 'Xóa', array('class' => 'btn btn-primary') ) }}
                            {{ Form::close() }}
                        </div>
                    @endif
                    @if( App\User::find(Auth::user()->id)->hasRole($user_role, '4') ||  App\User::find(Auth::user()->id)->isAdmin() )
                        <div id="manager_year" class="tab-pane fade">
                            <h3>Danh sách các năm học</h3>
                            {{ Form::open( array( 'url' => 'admin/multi_delete' ) ) }}
                            <ul class="list-group list-years">
                                <li class="list-group-item"><span class="year_name">Năm học</span><span
                                        class="year_modify">Chỉnh sửa</span><span
                                        class="year_delete">Xóa</span><span class="check_delete">Check</span></li>
                                @foreach ( $years as $count => $index )
                                    <li class="list-group-item">
                                        <span class="year_name">{{ $count + 1 }}. {{  $index['year_name'] }}</span>
                                    <span class="year_modify glyphicon glyphicon-edit" data-toggle="modal"
                                          data-target="#year_{{ $index['year_id'] }}"></span>
                                    <span id="{{ $index['year_id'] }}"
                                          class="year_delete delete glyphicon glyphicon-trash"></span>
                                        <!-- {{ Form::checkbox( 'id_array[]', $index['year_id'] ) }} -->
                                        <input type="checkbox" class="check-box-year" name="id_array[]"
                                               value="{{ $index['year_id'] }}"/>
                                    </li>
                                @endforeach
                                <li class="list-group-item">
                                    <label><input type="checkbox" class="checkAllYear"/> Check all</label>
                                    <span class="year_name"></span>
                                    <span class="year_modify"></span>
                                    <span class="year_delete delete"></span>
                                    {{ Form::submit( 'Xóa', array('class' => 'btn btn-primary') ) }}
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
                            @foreach( $years as $year )
                                <div class="modal fade" id="year_{{ $year['year_id'] }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
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
                                                                <p class="help-block">Username can contain any letters
                                                                    or
                                                                    numbers, without spaces</p>
                                                                <button class="btn btn-primary" role="button"
                                                                        type="submit">
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
                    @endif
                    @if(  App\User::find(Auth::user()->id)->isAdmin() )
                        <div id="manager_permission" class="tab-pane fade">
                            <ul class="list-group">
                                <li class="list-group-item"><span class="user_name">Tên Thành Viên</span>
                                    <span class="email">Email</span><span
                                        class="permission_edit">Chỉnh Sửa</span></li>
                                @foreach( $users as $user )
                                    @if( $user['is_admin'] != 1 )
                                        <li class="list-group-item">
                                        <span
                                            class="user_name">{{ $user['name'] }}</span>
                                            <span class="email">{{ $user['email'] }}</span>
                                        <span id="{{ $user['id'] }}" data-token="{{ csrf_token() }}"
                                              class="glyphicon glyphicon-edit permission_edit" data-toggle="modal"
                                              data-target="#user_{{ $user['id'] }}"></span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            @foreach( $users as $user )
                                <div class="modal fade" id="user_{{ $user['id'] }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Vai trò</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal"
                                                      action='{{ url('/admin/' . $user['id'] .'/updatePermission') }}'
                                                      method="POST">

                                                    <fieldset>
                                                        <?php $roles = App\User::find( $user['id'] )->roles ?>
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <label class="checkbox-inline">
                                                                    @if(App\User::find($user['id'])->hasRole($roles, '1'))
                                                                        <input type="checkbox" name="role[]" value="1"
                                                                               class="has_role">
                                                                    @else
                                                                        <input type="checkbox" name="role[]" value="1">
                                                                    @endif
                                                                    Cập nhật danh sách
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    @if(App\User::find($user['id'])->hasRole($roles, '2'))
                                                                        <input type="checkbox" name="role[]" value="2"
                                                                               class="has_role">
                                                                    @else
                                                                        <input type="checkbox" name="role[]" value="2">
                                                                    @endif
                                                                    Cập nhật điểm
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    @if(App\User::find($user['id'])->hasRole($roles, '3'))
                                                                        <input type="checkbox" name="role[]" value="3"
                                                                               class="has_role">
                                                                    @else
                                                                        <input type="checkbox" name="role[]" value="3">
                                                                    @endif
                                                                    Quản lí thành viên
                                                                </label>
                                                                <label class="checkbox-inline">
                                                                    @if(App\User::find($user['id'])->hasRole($roles, '4'))
                                                                        <input type="checkbox" name="role[]" value="4"
                                                                               class="has_role">
                                                                    @else
                                                                        <input type="checkbox" name="role[]" value="4">
                                                                    @endif
                                                                    Quản lí năm học
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Admin</label>
                                                            <div class="controls">
                                                                <label class="checkbox-inline"><input type="checkbox"
                                                                                                      name="isAdmin"
                                                                                                      value="1">Admin</label>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label"></label>
                                                            <div class="controls">
                                                                <button class="btn btn-success">Update</button>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body-script')
    {{ Html::script('/public/assets/js/main.js') }}
@endsection