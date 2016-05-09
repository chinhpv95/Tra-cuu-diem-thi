@extends('layouts.wrapper')

@section('head')
    <title>Search test score</title>
@endsection

@section('body')
    <header>
        <div class="container">
            <image src="{{ url('/') }}/public/assets/images/header.jpg"></image>
        </div>
    </header>
    <div class="container search-form">
        <div class="row">
            <div class="col-sm-12">
                {{ Form::open(array('url' => 'result', 'method' => 'GET')) }}
                {{ Form::text('auto', '', ['id' =>  'auto', 'class' => 'form-control', 'placeholder' =>  'Enter name'])}}
                <button class="button expand" type="submit" name="search" value="search"><span
                        class="glyphicon glyphicon-search search-icon"></span></button>
                <div class="advanced-options">
                    <p class="select-option">Tìm kiếm nâng cao</p>
                    <div class="options">
                        {{ Form::label('school-year', 'Năm học:', array('class' => 'awesome')) }}
                        <select name="select-year">
                            <option value="0">Chọn trong danh sách</option>
                            @foreach ($years as $year)
                                <option value="{{ $year['year_id'] }}">{{ $year['year_name'] }}</option>
                            @endforeach
                        </select>
                        {{ Form::label('semester', 'Học Kỳ:', array('class' => 'awesome')) }}
                        <select name="select-semester">
                            <option value="0">Chọn trong danh sách</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester['semester_id'] }}">{{ $semester['semester_name'] }}</option>
                                ';
                            @endforeach
                        </select>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        @if ( isset( $_GET['search'] ) )
            @if ( count( $result ) == 0 )
                <h4 class="class_error">Môn học không tồn tại, xin thử lại với tìm kiếm nâng cao</h4>
            @endif
        @endif
        @if ( isset( $_GET['search'] ) && count( $result ) != 0 && isset( $input['page'] ) )
            <ul class="list_result list-group">
                <li class="class_result list-group-item">
                    <span class="class_name">Môn Học</span>
                    <span class="teacher">Giáo Viên</span>
                </li>
                @foreach ( $result as $count => $index )
                    @if ( isset( $index['link'] ) )
                        <li class="class_result list-group-item">
                            <span class="class_name">{{ ( ( $input['page'] - 1 ) * 15 + $count + 1 ) }}. <a
                                    href="{{ url( 'public/storage' ) . '/' . $index['link'] }}"
                                    target="_blank">{{ $index['class_name'] . ' (' . $index['class_code'] }})</a></span>
                            <span class="teacher">{{ $index['teacher'] }}</span>
                            <span class="glyphicon glyphicon-ok"></span>
                        </li>
                    @else
                        <li class="class_result list-group-item">
                            <span class="class_name">{{ ( ( $input['page'] - 1 ) * 15 + $count + 1 ) }}
                                . {{ $index['class_name'] }} ({{ $index['class_code'] }})</span>
                            <span class="teacher">{{ $index['teacher'] }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
            {{ $result->appends( $input )->render() }}
        @endif
        @if ( isset( $_GET['search'] ) && count( $result ) != 0 && !isset( $input['page'] ) )
            <ul class="list_result list-group">
                <li class="class_result list-group-item">
                    <span class="class_name">Môn Học</span>
                    <span class="teacher">Giáo Viên</span>
                </li>
                @foreach ( $result as $count => $index )
                    @if ( isset( $index['link'] ) )
                        <li class="class_result list-group-item">
                            <span class="class_name">{{ ($count + 1)  }}. <a
                                    href="{{ url( 'public/storage' ) . '/' . $index['link'] }}"
                                    target="_blank">{{ $index['class_name'] . ' (' . $index['class_code'] }})</a></span>
                            <span class="teacher">{{ $index['teacher'] }}</span>
                            <span class="glyphicon glyphicon-ok"></span>
                        </li>
                    @else
                        <li class="class_result list-group-item">
                            <span class="class_name">{{ $count + 1 }}. {{ $index['class_name'] }}
                                ({{ $index['class_code'] }})</span>
                            <span class="teacher">{{ $index['teacher'] }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
            {{ $result->appends( $input )->render() }}
        @endif
    </div>
@endsection

@section('body-script')
    {{ Html::script('/public/assets/js/main.js') }}
    {{ Html::script('/public/assets/js/autocomplete.js') }}
    {{ Html::script('/public/assets/js/jquery.ui.autocomplete.html.js') }}
@endsection