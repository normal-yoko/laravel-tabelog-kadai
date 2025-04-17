@extends('layouts.app')
@section('content')

<div>
    <h3>予約</h3>
</div>

<h4>店舗名 ：  {{$store->name}} </h4>

<form action="{{route('reserves.store')}}" method="POST">
    @csrf

    <input type="hidden" name="store_id", value="{{ $store->id }}">

    <label for="reservation_date">予約日を選択してください:</label>
    <select name="reservation_date" id="reservation_date">
        <?php for ($i = 0; $i <= 14; $i++): ?>
            <?php
            // 日付をコピーして、日数を増やす
            $date_option = clone $current_date;
            $date_option->modify("+$i days");
            // フォーマットをYYYY-MM-DDに設定
            $formatted_date = $date_option->format('Y-m-d');
            ?>
            <option value="<?= $formatted_date ?>"><?= $formatted_date ?></option>
        <?php endfor; ?>
    </select>
    
    <label for="reservation_time">予約時間を選択してください:</label>
    <select name="reservation_time" id="reservation_time">
        <!-- 予約時間のオプションをここに追加 -->
        <option value="10:00">10:00</option>
        <option value="11:00">11:00</option>
        <option value="12:00">12:00</option>
        <option value="13:00">13:00</option>
        <option value="14:00">14:00</option>
        <option value="15:00">15:00</option>
        <option value="16:00">16:00</option>
        <option value="17:00">17:00</option>
        <option value="18:00">18:00</option>
        <option value="19:00">19:00</option>
        <option value="20:00">20:00</option>
    </select>

    <label for="reservation_time">予約人数を選択してください:</label>
    <select  name="headcount" id="headcount">
        <option value="" hidden>選択してください</option>
        @for ($i = 1; $i <=5; $i++)
            <option value="{{ $i }}">{{ $i }}名</option>
        @endfor
    </select>    
    <button type="submit">予約</button>
</form>



@endsection