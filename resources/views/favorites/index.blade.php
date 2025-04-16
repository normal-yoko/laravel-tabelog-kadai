@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <div class="row w-100">
            @foreach($favorites_stores as $favorite_store)
            <div class="col-3">
                <a href="{{route('stores.show', $favorite_store)}}">
                    @if ($favorite_store->image !== "")
                    <img src="{{ asset($favorite_store->image) }}" class="img-thumbnail">
                    @else
                    <img src="{{ asset('img/dummy.jpg')}}" class="img-thumbnail">
                    @endif
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="store-label mt-2">
                            {{$favorite_store->name}}<br>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection