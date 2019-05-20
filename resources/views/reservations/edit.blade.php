@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>详细信息</h2>
        </div>
        <div class="panel-body">
            <div class="col-sm-6 photo">
                <img src="{{ $reservation->credential }}" alt="Credential">
                <div class="btns">
                    <form method="post" action="{{ route('reservations.update', $reservation->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="review" value="1">
                        <button type="submit" class="btn btn-primary">同意</button>
                    </form>
                    <form method="post" action="{{ route('reservations.update', $reservation->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="review" value="0">
                        <button type="submit" class="btn btn-danger">拒绝</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 info">
                <ul class="list-group">
                    <li class="list-group-item">申请人：{{ $reservation->name }}</li>
                    <li class="list-group-item">人数：{{ $reservation->population }}</li>
                    <li class="list-group-item">单位：{{ $reservation->organization }}</li>
                    <li class="list-group-item">电话：{{ $reservation->phone }}</li>
                    <li class="list-group-item">备注：{{ $reservation->remarks }}</li>
                    <li class="list-group-item">日期：{{ implode('-', [$reservation->year, $reservation->month, $reservation->day]) }}</li>
                    <li class="list-group-item">时间：
                        @foreach($reservation->blocks as $block)
                            {{ block_time(get_weather($reservation->month), $block) }}
                        @endforeach
                    </li>
                    <li class="list-group-item">审核状态：
                        @if(!isset($reservation->review))
                            未审核
                        @elseif($reservation->review)
                            已通过
                        @else
                            已拒绝
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection