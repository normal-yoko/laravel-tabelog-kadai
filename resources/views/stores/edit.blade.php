@extends('layouts.app')

@section('content')

<div>
   <h2>店舗編集</h2>
</div>
<div>
   <a href="{{ route('stores.index') }}"> 戻る</a>
</div>

<form action="{{ route('stores.update',$store->id) }}" method="POST">
   @csrf
   @method('PUT')
   <div>
       <strong>ジャンル:</strong>
       <select class="form-control" id="category-id" value="{{$store->category_id}}" name="category_id">
       @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{  $category->name }} </option>
       @endforeach
      </select>
   </div>
   <div>
       <strong>店名:</strong>
       <input type="text" name="name" value="{{$store->name}}" placeholder="">
   </div>

   <div>
       <strong>店舗説明:</strong>
       <textarea style="height:150px" name="description" value="{{$store->description}}" placeholder="">{{$store->description}}</textarea>
   </div>
   <div>
       <strong>最低価格:</strong>
       <input type="number" name="under_price"  value="{{$store->under_price}}" placeholder="500">
   </div>
   <div>
       <strong>最高価格:</strong>
       <input type="number" name="upper_price"  value="{{$store->upper_price}}" placeholder="5000">
   </div>
   <div>
       <strong>開始時間:</strong>
       <input type="text" name="open_time" value="{{$store->open_time}}" placeholder="10時">
   </div>
   <div>
       <strong>閉店時間:</strong>
       <input type="text" name="closed_time" value="{{$store->closed_time}}" placeholder="22時">
   </div>
   <div>
       <strong>郵便番号:</strong>
       <input type="text" name="postal_code" value="{{$store->postal_code}}" placeholder="0001234">
   </div>
   <div>
       <strong>住所:</strong>
       <input type="text" name="address" value="{{$store->address}}" placeholder="大阪府">
   </div>
   <div>
       <strong>電話番号:</strong>
       <input type="text" name="phone" value="{{$store->phone}}" placeholder="09012345678">
   </div>
   <div>
       <strong>定休日:</strong>
       <input type="text" name="closed_day" value="{{$store->closed_day}}" placeholder="第3月曜日">
   </div>

   <div>
       <button type="submit">更新</button>
   </div>

</form>
@endsection