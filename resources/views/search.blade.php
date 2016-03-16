@extends('layouts.wrapper')

@section('head')
    <title>Search test score</title>
@endsection

@section('head.style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css"/>
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/jquery-ui.css">


@endsection

@section('body')
    <header>
        <image src="http://student.uet.vnu.edu.vn/images/logo.png"></image>
    </header>
    <div class="container search-form">
        <div class="row">
            <div class="col-sm-12">
                {{ Form::open(array('url' => 'result', 'method' => 'POST')) }}
                {{ Form::text('auto', '', ['id' =>  'auto', 'class' => 'form-control', 'placeholder' =>  'Enter name'])}}
                <button class="button expand" type="submit" name="search" value="search"><span
                        class="glyphicon glyphicon-search search-icon"></span></button>
                <div class="advanced-options">
                    <p class="select-option">Tìm kiếm nâng cao</p>
                    <div class="options">
                        <?php
                        $years = App\Year::select('year_id', 'year_name')->get();
                        $semesters = App\Semester::select('semester_id', 'semester_name')->get();
                        ?>
                        {{ Form::label('school-year', 'Năm học:', array('class' => 'awesome')) }}
                        <select name="select-year">
                            <option value="0">Chọn trong danh sách</option>
                            <?php
                            foreach ($years as $year) {
                                echo '<option value="' . $year['year_id'] . '">' . $year['year_name'] . '</option>';
                            }
                            ?>
                        </select>
                        {{ Form::label('semester', 'Học Kỳ:', array('class' => 'awesome')) }}
                        <select name="select-semester">
                            <option value="0">Chọn trong danh sách</option>
                            <?php
                            foreach ($semesters as $semester) {
                                echo '<option value="' . $semester['semester_id'] . '">' . $semester['semester_name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <?php
        if (isset($_POST['search'])) {
            echo '<ul class="list_result list-group">';
            foreach ($result as $count => $index) {
                $count++;
                if (isset($index['link'])) {
                    echo '<li class="class_result list-group-item">' . $count .'. ';
                    echo '<a href="' . url('storage') . '/' . $index["link"] . '" target="_blank">' . $index['class_name'] . ' (' . $index['class_code'] . ')</a>';
                    echo '<span>' .$index['teacher'] .'</span>';
                    echo '<span class="glyphicon glyphicon-ok"></span></li>';
                } else {
                    echo '<li class="class_result list-group-item">' . $count .'. ';
                    echo $index['class_name'] . ' (' . $index['class_code'] . ')';
                    echo '<span>' .$index['teacher'] .'</span>';
                    echo '</li>';
                }
            }
            echo '</ul>';
        }
        ?>
    </div>
@endsection

@section('body.script')
    {{ Html::script('assets/js/jquery.min.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/bootstrap.min.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/jquery-ui.min.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/main.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/autocomplete.js', array('async' => 'async')) }}
    {{ Html::script('assets/js/jquery.ui.autocomplete.html.js', array('async' => 'async')) }}
@endsection