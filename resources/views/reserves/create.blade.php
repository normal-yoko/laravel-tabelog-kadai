@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-4 text-center">
        <h2 class="fw-bold">予約フォーム</h2>
        <p class="text-muted">以下の内容を入力してください。</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">店舗名： <span class="text-primary">{{ $store->name }}</span></h4>

            <form action="{{ route('reserves.store') }}" method="POST">
                @csrf
                <input type="hidden" name="store_id" value="{{ $store->id }}">

                <div class="mb-3">
                    <label for="reservation_date" class="form-label">予約日を選択してください:</label>
                    <select class="form-select" name="reservation_date" id="reservation_date">
                        @for ($i = 0; $i <= 14; $i++)
                            @php
                                $date_option = clone $current_date;
                                $date_option->modify("+$i days");
                                $formatted_date = $date_option->format('Y-m-d');
                            @endphp
                            <option value="{{ $formatted_date }}">{{ $formatted_date }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="reservation_time" class="form-label">予約時間を選択してください:</label>
                    <select class="form-select" name="reservation_time" id="reservation_time">
                        @for ($h = 10; $h <= 20; $h++)
                            <option value="{{ sprintf('%02d:00', $h) }}">{{ sprintf('%02d:00', $h) }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-4">
                    <label for="headcount" class="form-label">予約人数を選択してください:</label>
                    <select class="form-select" name="headcount" id="headcount">
                        <option value="" hidden>選択してください</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}名</option>
                        @endfor
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5">予約する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
