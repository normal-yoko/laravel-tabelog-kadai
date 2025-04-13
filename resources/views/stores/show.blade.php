@extends('layouts.app')

@section('content')
<div>
   <h2>店舗表示</h2>
</div>
<div>
   <a href="{{ route('stores.index') }}"> 戻る</a>
</div>
<form >
   <div>
       <strong>ジャンル:</strong>
       {{ $store->category->name }}
   </div>
   <div>
       <strong>店名:</strong>
      {{ $store->name }}
    </div>
    <div>
       <strong></strong>
        @if ($store->image !== "")
        <img src="{{ asset($store->image) }}" class="img-thumbnail">
        @else
        <img src="{{ asset('img/dummy.jpg')}}" class="img-thumbnail">
        @endif
   </div>
   <div>
       <strong>店舗説明:</strong>
       {{ $store->description }}
       </div>
   <div>
       <strong>最低価格:</strong>
       {{ $store->under_price }}
       </div>
   <div>
       <strong>最高価格:</strong>
       {{ $store->upper_price }}
       </div>
   <div>
       <strong>開始時間:</strong>
       {{ $store->open_time }}
       </div>
   <div>
       <strong>閉店時間:</strong>
       {{ $store->closed_time }}
       </div>
   <div>
       <strong>郵便番号:</strong>
       {{ $store->postal_code }}
       </div>
   <div>
       <strong>住所:</strong>
       {{ $store->address }}
       </div>
   <div>
       <strong>電話番号:</strong>
       {{ $store->phone }}
       </div>
   <div>
       <strong>定休日:</strong>
       {{ $store->closed_day }}
    </div>
    <div>
        <a href="{{ route('reviews.index',$store->id) }}">レビューをみる</a>
    </div>
    <div class="col-5">
        @if(Auth::user()->favorite_stores()->where('store_id', $store->id)->exists())
            <a href="{{ route('favorites.destroy', $store->id) }}" class="btn laravel-tabelog-kadai-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                <i class="fa fa-heart"></i>
                お気に入り解除
            </a>
        @else
            <a href="{{ route('favorites.store', $store->id) }}" class="btn laravel-tabelog-kadai-favorite-button2 text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                <i class="fa fa-heart"></i>
                お気に入り
            </a>
        @endif
    </div>

</form>
<form id="favorites-destroy-form" action="{{ route('favorites.destroy', $store->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
<form id="favorites-store-form" action="{{ route('favorites.store', $store->id) }}" method="POST" class="d-none">
    @csrf
</form>
@endsection