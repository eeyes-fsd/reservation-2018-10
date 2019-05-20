@extends('layouts.app')

@section('content')
    <a class="btn btn-link" href="{{ route('memos.create') }}">创建新的记录</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">开始时间</th>
            <th scope="col">详细信息</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($memos as $memo)
            <tr>
                <th scope="row">{{ $memo->id }}</th>
                <th scope="row">{{ $memo->start->diffForHumans() }}</th>
                <th scope="row">{{ $memo->information }}</th>
                <th scope="row">
                    <form method="post" action="{{ route('memos.destroy', $memo->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                </th>
        @endforeach
        </tbody>
    </table>

    {!! $memos->render() !!}
@endsection