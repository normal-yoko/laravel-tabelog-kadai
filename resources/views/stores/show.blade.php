@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">店舗詳細</h2>

    <div class="text-center mb-4">
        <a href="{{ route('stores.index') }}" class="btn btn-outline-secondary">← 戻る</a>
    </div>

    <div class="row mb-5">
        <div class="col-md-5 text-center">
            <img src="{{ $store->image ? asset($store->image) : asset('img/dummy.jpg') }}"
                 class="img-fluid rounded shadow-sm" style="max-height: 300px;">
        </div>
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table mb-0">
                        <tr><th>店舗名</th><td>{{ $store->name }}</td></tr>
                        <tr><th>説明</th><td>{{ $store->description }}</td></tr>
                        <tr><th>営業時間</th><td>{{ $store->open_time }} ～ {{ $store->closed_time }}</td></tr>
                        <tr><th>価格</th><td>{{ $store->under_price }} ～ {{ $store->upper_price }} 円</td></tr>
                        <tr><th>郵便番号</th><td>〒{{ $store->postal_code }}</td></tr>
                        <tr><th>住所</th><td>{{ $store->address }}</td></tr>
                        <tr><th>電話番号</th><td>{{ $store->phone }}</td></tr>
                        <tr><th>定休日</th><td>{{ $store->closed_day }}</td></tr>
                        <tr><th>カテゴリ</th><td>{{ $store->category->name }}</td></tr>
                    </table>
                </div>
            </div>

            @auth
                @if (Auth::user()->paid_flg == 1)
                    <div class="mt-4 d-flex flex-wrap gap-3">
                        <a href="{{ route('reserves.create', $store->id) }}" class="btn btn-primary">
                            予約する
                        </a>

                        @if(Auth::user()->favorite_stores()->where('store_id', $store->id)->exists())
                            <a href="#" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();" class="btn btn-outline-danger">
                                <i class="fa fa-heart"></i> お気に入り解除
                            </a>
                        @else
                            <a href="#" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();" class="btn btn-outline-success">
                                <i class="fa fa-heart"></i> お気に入り登録
                            </a>
                        @endif
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $store->id) }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
    <form id="favorites-store-form" action="{{ route('favorites.store', $store->id) }}" method="POST" class="d-none">
        @csrf
    </form>

    <h2 class="text-center mb-4">レビュー一覧</h2>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            @foreach($reviews as $review)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <strong>{{ $review->user->name }}</strong>
                            <span class="text-warning">{{ str_repeat('★', $review->star_count) }}</span>
                        </div>
                        <p class="mb-0">{{ $review->comment }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @auth
        @if (Auth::user()->paid_flg == 1)
            <h2 class="text-center mb-4">レビュー投稿</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <input type="hidden" name="store_id" value="{{ $store->id }}">

                        <div class="mb-3">
                            <label for="star_count" class="form-label">評価</label>
                            <select class="form-select" name="star_count">
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★</option>
                                <option value="3" selected>★★★</option>
                                <option value="2">★★</option>
                                <option value="1">★</option>
                                <option value="0">なし</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">レビュー内容</label>
                            <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
                            @error('comment')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">レビューを投稿する</button>
                    </form>
                </div>
            </div>
        @endif
    @endauth
</div>
@endsection
