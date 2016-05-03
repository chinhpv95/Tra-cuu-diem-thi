@extends('layouts.app')

@section('title')
    <title>Login</title>
@endsection


@section('body')
    <div class="container">
        <form class="form-signin">
            <h2 class="form-signin-heading">Login</h2>
            <input type="text" class="form-control" name="username" placeholder="Email Address" required=""
                   autofocus=""/>
            <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
            <label class="checkbox">
                <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
    </div>
@endsection

@section('body-script')
    {{ Html::script('/public/assets/js/main.js') }}
@endsection