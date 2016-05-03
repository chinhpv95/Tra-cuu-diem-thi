@extends('layouts.app')

@section('title')
    <title>Profile</title>
@endsection

@section('admin')
    <a class="navbar-brand" href="{{ url('/admin') }}">
        Admin
    </a>
@endsection


@section('body')
    <div class="container">
        <div class="row">
            <div class="image-avatar">
                {{ Form::open(array('url' => url('/profile/' . $data['id'] . '/updateAvatar'), 'method' => 'post', 'files' => true)) }}
                <label class="label-avatar">Avatar</label>
                @if( $data['image'] != null )
                    <img id='img-upload' src="{{ url('public/storage/images/'.$data["image"]) }}" alt="avatar"/>
                @else
                    <img id='img-upload' src="{{ url('public/storage/images/avatar.jpg') }}" alt="avatar"/>
                @endif
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">Browse… <input type="file" id="imgInp" name="image_name">
                        </span>
                    </span>
                    <input type="text" class="form-control image_name" readonly>
                </div>
                <button class="btn btn-primary update_image" type="submit">Update</button>
                {{ Form::close() }}
            </div>
            <ul class="list-group show_profile">
                <li class="list-group-item"><span>Name</span>
                    <span class="name">{{ $data['name'] }}</span>
                    <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#name"></span>
                </li>
                <li class="list-group-item">
                    <span>Email</span>
                    <span class="email">{{ $data['email'] }}</span>
                    <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#email"></span>
                </li>
                <li class="list-group-item">
                    <span>Password</span>
                    <span class="password">Password never changed</span>
                    <span class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#password"></span>
                </li>
            </ul>

            <!-- Modal -->
            <div class="modal fade" id="name" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Name</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action='{{ url('/profile/' . $data['id'] . '/updateName') }}'
                                  method="POST">

                                <fieldset>
                                    <div class="control-group">
                                        <!-- Username -->
                                        <label class="control-label">Username</label>
                                        <div class="controls">
                                            <input type="text" id="username" name="username" placeholder=""
                                                   class="form-control" value="{{ $data['name'] }}">
                                            <p class="help-block">Username can contain any letters or
                                                numbers, without spaces</p>
                                            <button class="btn btn-primary" role="button" type="submit">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Email</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" action='{{ url('/profile/' . $data['id'] . '/updateEmail') }}'
                                  method="POST">

                                <fieldset>
                                    <div class="control-group">
                                        <!-- Username -->
                                        <label class="control-label">Email</label>
                                        <div class="controls">
                                            <input type="text" id="email" name="email" placeholder=""
                                                   class="form-control" value="{{ $data['email'] }}">
                                            <p class="help-block">Please provide your E-mail</p>
                                            <button class="btn btn-primary" role="button" type="submit">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Password</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal"
                                  action='{{ url('/profile/' . $data['id'] . '/updatePassword') }}'
                                  method="POST">

                                <fieldset>
                                    <div class="control-group">
                                        <!-- Username -->
                                        <label class="control-label">Password</label>
                                        <div class="controls">
                                            <input type="password" id="username" name="password" placeholder=""
                                                   class="form-control" value="{{ $data['password'] }}">
                                            <p class="help-block">Password should be at least 4
                                                characters</p>
                                            <button class="btn btn-primary" role="button" type="submit">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(Session::has('updateName_message'))
                <div class="alert alert-success">
                    {{ Session::get('update_message') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('body-script')
    {{ Html::script('/public/assets/js/main.js') }}
@endsection