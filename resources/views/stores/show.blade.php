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

    @if (  Auth::user()->paid_flg == 1)
    <div>
        <a href="{{ route('reserves.index',$store->id) }}">予約</a>
    </div>    
    <div>
        @if(Auth::user()->favorite_stores()->where('store_id', $store->id)->exists())
            <a href="{{ route('favorites.destroy', $store->id) }}"  onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                <i class="fa fa-heart"></i>
                お気に入り解除
            </a>
        @else
            <a href="{{ route('favorites.store', $store->id) }}" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                <i class="fa fa-heart"></i>
                お気に入り登録
            </a>
        @endif
    </div>
    @endif
</form>
<form id="favorites-destroy-form" action="{{ route('favorites.destroy', $store->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
<form id="favorites-store-form" action="{{ route('favorites.store', $store->id) }}" method="POST" class="d-none">
    @csrf
</form>
<br>       
 <div>
    <h4>レビュー</h4>
 <!-- レビューを実装する箇所になります -->
    <div>
        @foreach($reviews as $review)
        <div>
        <label>【評価】　{{ str_repeat('☆',$review->star_count) }} 【投稿者】　{{$review->user->name}}  【投稿日時】　 {{$review->created_at}}</label>

        <p>{{$review->comment}}</p>
        </div>
        @endforeach
    </div><br />

    @auth
    <div>
        <div>
            <form method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <h4>レビュー内容</h4>
                <div class="col-auto">
                    <select class="form-control" name="star_count">
                        <option value="5" selected> ☆☆☆☆☆ </option>
                        <option value="4" selected> ☆☆☆☆ </option>
                        <option value="3" selected> ☆☆☆ </option>
                        <option value="2" selected> ☆☆ </option>
                        <option value="1" selected> ☆ </option>
                        <option value="0" selected>  </option>
                    </select>
                </div>
                @error('content')
                    <strong>レビュー内容を入力してください</strong>
                @enderror
                <textarea name="comment" class="form-control m-2"></textarea>
                <input type="hidden" name="store_id" value="{{$store->id}}">
                <button type="submit" class="btn tabelog-submit-button ml-2">レビューを追加</button>
            </form>
        </div>
    </div>
    @endauth
</div>

@endsection