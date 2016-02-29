@extends('layouts.wrapper')

@section('head')
    <title>Search test score</title>
@endsection

@section('head.style')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css"/>
@endsection

@section('body')
    <div class="container search-form">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('search') }}" data-toggle="validator" method="POST">
                    {!! csrf_field() !!}
                    <input type="text" name="s" value="" placeholder="Enter subject code to search"
                           class="form-control">
                    <span class="glyphicon glyphicon-search"></span>
                </form>
                <div class="advanced-options">
                    <p class="select-option">Advanced Options</p>
                    <div class="options">
                        <?php echo Form::label('school-year', 'Năm học:', array('class' => 'awesome')); ?>
                        <?php echo Form::select('select-year', array('1' => 'Năm học 2014-2015', '2' => 'Năm học 2015-2016')); ?>
                        <?php echo Form::label('semester', 'Học Kỳ:', array('class' => 'awesome')); ?>
                        <?php echo Form::select('select-semester', array('1' => 'Học kỳ 1', '2' => 'Học kỳ 2')); ?>
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