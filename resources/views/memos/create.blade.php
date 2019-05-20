@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            创建备忘录
        </div>
        <div class="panel-body">
            <form action="{{ route('memos.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="start">开始时间</label>
                    <input type="datetime-local" name="start" id="start" class="form-control">
                </div>
                <div class="form-group">
                    <label for="information">详细信息</label>
                    <input type="text" name="information" id="information" class="form-control">
                </div>
                <button class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
@endsection