@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            登录管理后台
        </div>
        <div class="panel-body">
            <form method="post" action="{{ route('login.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="password">密码：</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">登陆</button>
            </form>
        </div>
    </div>
@endsection