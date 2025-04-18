@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4">予約編集</h2>

    <div class="mb-4">
        <h4 class="text-center">店舗名： {{$reserve->store->name}}</h4>
    </div>

    <!-- 予約一覧に戻るリンク -->
    <div class="mb-4 text-center">
        <a href="{{ route('reserves.index') }}" class="btn btn-secondary">予約一覧に戻る</a>
    </div>


    <form action="{{ route('reserves.update', $reserve->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $reserve->id }}">

        <div class="mb-3">
            <label for="reservation_date" class="form-label">予約日を選択してください:</label>
            @php
                $reservationDate = \Carbon\Carbon::parse($reserve->reservation_date)->format('Y-m-d');
                $current_date = \Carbon\Carbon::now();  // 現在の日付を取得
            @endphp
            <select name="reservation_date" id="reservation_date" class="form-select">
                @for ($i = 0; $i <= 14; $i++)
                    @php
                        $date_option = clone $current_date;
                        $date_option->modify("+$i days");
                        $formatted_date = $date_option->format('Y-m-d');
                    @endphp
                    
                    <option value="{{ $formatted_date }}" @if($reservationDate === $formatted_date) selected @endif>{{ $formatted_date }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="reservation_time" class="form-label">予約時間を選択してください:</label>
            @php
                $reservationTime = \Carbon\Carbon::parse($reserve->reservation_time)->format('H:i');
            @endphp
            <select name="reservation_time" id="reservation_time" class="form-select">
                @for ($hour = 10; $hour <= 21; $hour++) 
                    @for ($minute = 0; $minute < 60; $minute+=30)
                        @php
                            $time_option = sprintf('%02d:%02d', $hour, $minute);
                        @endphp
                        
                        <option value="{{ $time_option }}" @if($reservationTime === $time_option) selected @endif>{{ $time_option }}</option>
                    @endfor
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="headcount" class="form-label">予約人数を選択してください:</label>
            <select name="headcount" id="headcount" class="form-select">
                <option value="" hidden>選択してください</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" @if ($reserve->headcount == $i) selected @endif>{{ $i }}名</option>
                @endfor
            </select>    
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">予約内容を変更</button>
        </div>
    </form>
</div>
@endsection
