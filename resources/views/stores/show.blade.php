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
</form>