@foreach ( $latest_class as $index )
    @if ( ! isset( $index['link'] ) )
    
        <li class="list-group-item" data-id="{{ $index['id'] }}"><span>{{ $index['class_name'] }}
                ({{ $index['class_code'] }})</span>
            {{ Form::open( array( 'url' => route( 'upLoad', [ 'class_id' => $index['id'] ] ), 'method' => 'POST', 'files' => true ) ) }}
            <span class="btn-file btn btn-primary">Select File{{ Form::file( 'link' ) }}</span>
            {{ Form::submit( 'Upload', array( 'class' => 'btn btn-primary' ) ) }}
            {{ Form::close() }}

            {{ Form::open( array( 'url' => route( 'downLoad', [ 'class_id' => $index['id'] ] ), 'method' => 'POST', 'files' => true ) ) }}
            {{Form::submit( 'Download', array( 'class' => 'btn btn-primary' ) ) }}
            <div id="{{$index['id']}}" class="sendemail btn btn-primary">Send Mail</div>
            {{Form::close()}}
        </li>

    @else
        <li class="list-group-item" data-id="{{ $index['id'] }}">
            <a href="{{ url( 'public/storage' ) }}/{{ $index["link"] }}" target="_blank">
                <span>{{ $index['class_name'] }} ({{ $index['class_code'] }})</span>
            </a>

            {{ Form::open( array( 'url' => route( 'upLoad', [ 'class_id' => $index['id'] ] ), 'method' => 'POST', 'files' => true ) ) }}
            <span class="btn-file btn btn-primary">Select File{{ Form::file( 'link' ) }}</span>
            {{ Form::submit( 'Upload', array( 'class' => 'btn btn-primary' ) ) }}
            {{ Form::close() }}

            {{ Form::open( array( 'url' => route( 'downLoad', [ 'class_id' => $index['id'] ] ), 'method' => 'POST', 'files' => true )) }}
            {{ Form::submit( 'Download', array( 'class' => 'btn btn-primary' ) ) }}
            {{ Form::close() }}

            <span class="glyphicon glyphicon-ok"></span>
        </li>
        
    @endif
@endforeach