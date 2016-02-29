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
            <div class="col-sm-3">
                <ul class="nav nav-tabs manager">
                    <li class="active"><a data-toggle="tab" href="#home">Cập nhật danh sach</a></li>
                    <li><a data-toggle="tab" href="#manager">Quản lý</a></li>
                </ul>
            </div>

            <div class="col-sm-9">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="upload-file">
                            <p>Chọn file excel để import vào cơ sở dữ liệu</p>
                            <?php echo Form::file('xls'); ?>
                            <button class="btn btn-primary" type="submit">Import</button>
                        </div>
                        <form action="{{ route('admin') }}" data-toggle="validator" method="POST">
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
                                    echo '<td>' . Form::select('select-semester', array(
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
                                    echo '<td>' . Form::text('class-input') . '</td>';
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
                                    echo '<td></td><td><a class="btn btn-primary" href="#" role="button">Submit</a></td>';
                                    ?>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div id="manager" class="tab-pane fade">
                        <div class="add-user">
                            <a class="btn btn-primary" href="#" role="button">Add User</a>
                        </div>
                        <div class="list-user">
                            <ul>
                                <li></li>
                            </ul>
                        </div>
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