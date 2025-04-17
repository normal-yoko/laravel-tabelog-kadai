@extends('layouts.app')
@section('content')

<div>
    <h3>予約編集</h3>
</div>

<h4>店舗名 ：  {{$reserve->store->name}} </h4>

<form action="{{ route('reserves.update', $reserve->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="id" value="{{ $reserve->id }}">

    <label for="reservation_date">予約日を選択してください:</label>

    @php
        $reservationDate = \Carbon\Carbon::parse($reserve->reservation_date)->format('Y-m-d');
        $current_date = \Carbon\Carbon::now();  // 現在の日付を取得
    @endphp

    <select name="reservation_date" id="reservation_date">
        @for ($i = 0; $i <= 14; $i++)
            @php
                $date_option = clone $current_date;
                $date_option->modify("+$i days");
                $formatted_date = $date_option->format('Y-m-d');
            @endphp
            
            <option value="{{ $formatted_date }}" @if($reservationDate === $formatted_date) selected @endif>{{ $formatted_date }}</option>
        @endfor
    </select>

    <label for="reservation_time">予約時間を選択してください:</label>

    @php
        $reservationTime = \Carbon\Carbon::parse($reserve->reservation_time)->format('H:i');
    @endphp

    <select name="reservation_time" id="reservation_time">
        @for ($hour = 10; $hour <= 21; $hour++) 
            @for ($minute = 0; $minute < 60; $minute+=30)
                @php
                    $time_option = sprintf('%02d:%02d', $hour, $minute);
                @endphp
                
                <option value="{{ $time_option }}" @if($reservationTime === $time_option) selected @endif>{{ $time_option }}</option>
            @endfor
        @endfor
    </select>

    <label for="headcount">予約人数を選択してください:</label>
    <select name="headcount" id="headcount">
        <option value="" hidden>選択してください</option>
        @for ($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}" @if ($reserve->headcount == $i) selected @endif>{{ $i }}名</option>
        @endfor
    </select>    
    <button type="submit">予約内容を変更</button>
</form>

@endsection