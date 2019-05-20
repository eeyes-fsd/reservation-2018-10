@extends('layouts.app')

@section('content')
    <div class="jumbotron col-sm-6">
        <h1>预约管理系统</h1>
        <p>在这管理所有预约……</p>
        <a href="{{ route('reservations.index') }}" class="btn btn-primary btn-lg">点击进入</a>
    </div>
    <div class="jumbotron col-sm-6">
        <h1>备忘录系统</h1>
        <p>在这开始您的备忘……</p>
        <a href="{{ route('memos.index') }}"  class="btn btn-primary btn-lg">点击进入</a>
    </div>
@endsection