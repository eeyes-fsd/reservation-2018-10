@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">姓名</th>
                <th scope="col">单位</th>
                <th scope="col">人数</th>
                <th scope="col">申请时间</th>
                <th scope="col">审核状态</th>
                <th scope="col">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <th scope="row">{{ $reservation->id }}</th>
                    <th scope="row">{{ $reservation->name }}</th>
                    <th scope="row">{{ $reservation->organization }}</th>
                    <th scope="row">{{ $reservation->population }}</th>
                    <th scope="row">{{ implode('-', [$reservation->year, $reservation->month, $reservation->day]) }}</th>
                    @if(!isset($reservation->review))
                        <th scope="row">未审核</th>
                    @elseif($reservation->review)
                        <th scope="row">已通过</th>
                    @else
                        <th scope="row">已拒绝</th>
                    @endif
                    <th scope="row"><a href="{{ route('reservations.edit', [$reservation]) }}">详情</a></th>
            @endforeach
        </tbody>
    </table>

    {!! $reservations->render() !!}
@endsection