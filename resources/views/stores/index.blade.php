@extends('layouts.app')

@section('content')

<a href="{{ route('stores.create') }}"> 店舗新規登録</a>
                

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
        {{ $stores->links() }}
    </div>
@endsection