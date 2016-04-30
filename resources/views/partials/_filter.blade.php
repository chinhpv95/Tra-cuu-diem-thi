@foreach ( $latest_class as $index )
    @if ( ! isset( $index['link'] ) )
    
        <li class="list-group-item" data-id="{{ $index['class_id'] }}"><span>{{ $index['class_name'] }}
                ({{ $index['class_code'] }})</span>
            {{ Form::open( array( 'url' => route( 'upLoad', [ 'class_id' => $index['class_id'] ] ), 'method' => 'POST', 'files' => true ) ) }}
            {{ Form::file( 'link' ) }}
            {{ Form::submit( 'Upload', array( 'class' => 'btn btn-primary' ) ) }}
            {{ Form::close() }}

            {{ Form::open( array( 'url' => route( 'downLoad', [ 'class_id' => $index['class_id'] ] ), 'method' => 'POST', 'files' => true ) ) }}
            {{Form::submit( 'Download', array( 'class' => 'btn btn-primary' ) ) }}
            <div id="{{$index['class_id']}}"
                                          class="sendemail glyphicon glyphicon-envelope"></div>
            {{Form::close()}}
        </li>

    @else
        <li class="list-group-item" data-id="{{ $index['class_id'] }}">
            <a href="{{ url( 'storage' ) }}/{{ $index["link"] }}" target="_blank">
                <span>{{ $index['class_name'] }} ({{ $index['class_code'] }})</span>
            </a>

            {{ Form::open( array( 'url' => route( 'upLoad', [ 'class_id' => $index['class_id'] ] ), 'method' => 'POST', 'files' => true ) ) }}
            {{ Form::file( 'link' ) }}
            {{ Form::submit( 'Upload', array( 'class' => 'btn btn-primary' ) ) }}
            {{ Form::close() }}

            {{ Form::open( array( 'url' => route( 'downLoad', [ 'class_id' => $index['class_id'] ] ), 'method' => 'POST', 'files' => true )) }}
            {{ Form::submit( 'Download', array( 'class' => 'btn btn-primary' ) ) }}
            {{ Form::close() }}
            
            <div id="{{$index['class_id']}}"
                                          class="sendemail glyphicon glyphicon-envelope"></div>
            <span class="glyphicon glyphicon-ok"></span>
        </li>
        
    @endif
@endforeach