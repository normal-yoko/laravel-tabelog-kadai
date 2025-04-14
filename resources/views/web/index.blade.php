@extends('layouts.app')
@section('content')

<form action="{{ route('stores.index') }}" method="GET" class="row g-1">
@csrf
  <div class="col-auto">
      <input class="form-control" name="keyword">
  </div>
  <div class="col-auto">
    <select class="form-control" id="category-id" name="category_id">
          <option value="" selected> カテゴリー </option>
          @foreach ($categories as $category)
              <option value="{{ $category->id }}"> {{  $category->name }} </option>
          @endforeach
    </select>
  </div>
  <div class="col-auto">
        <button type="submit" class="serch_button" >検索</button>
  </div>
</form>


@endsection