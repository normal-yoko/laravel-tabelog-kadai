@extends('layouts.app')

@section('content')

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form action="{{ route('stores.index') }}" method="GET" class="row g-1">
@csrf
    <div class="d-flex justify-content-center mb-5">
        <div class="col-auto">
            <input class="form-control" name="keyword" placeholder="店舗名で検索">
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
                <button type="submit" class="serch_button"  >検索</button>
        </div>
    </div>
</form>
    <div class="container mt-4">
        <div class="row w-100">
            @foreach($stores as $store)
            <div class="col-3">
                <a href="{{route('stores.show', $store)}}">
                    @if ($store->image !== "")
                    <img src="{{ asset($store->image) }}" class="img-thumbnail">
                    @else
                    <img src="{{ asset('img/dummy.jpg')}}" class="img-thumbnail">
                    @endif
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="store-label mt-2">
                            {{$store->name}}<br>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection