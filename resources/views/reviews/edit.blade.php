@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center mb-5">
    <a href="{{ route('reviews.index') }}">レビュー一覧へ戻る</a>
</div>
<form method="POST" action="{{ route('reviews.update',$review) }}">
    @csrf
    @method('PUT')
    <h2 class="text-center mb-3">レビュー内容</h2>
    <div class="text-center mb-3">
        <label for="exampleFormControlInput1" class="form-label">評価</label>
        <select class="w-15 p-3" aria-label="Default select example" Width 50% name="star_count" >
            @if($review->star_count == 0)
                <option value="5" > ☆☆☆☆☆ </option>
                <option value="4" > ☆☆☆☆ </option>
                <option value="3" > ☆☆☆ </option>
                <option value="2" > ☆☆ </option>
                <option value="1" > ☆ </option>
                <option value="0" selected>  </option>
            @elseif($review->star_count == 1)
                <option value="5" > ☆☆☆☆☆ </option>
                <option value="4" > ☆☆☆☆ </option>
                <option value="3" > ☆☆☆ </option>
                <option value="2" > ☆☆ </option>
                <option value="1" selected> ☆ </option>
                <option value="0" >  </option>
            @elseif($review->star_count == 2)
                <option value="5" > ☆☆☆☆☆ </option>
                <option value="4" > ☆☆☆☆ </option>
                <option value="3" > ☆☆☆ </option>
                <option value="2"selected > ☆☆ </option>
                <option value="1" > ☆ </option>
                <option value="0" >  </option>
            @elseif($review->star_count == 3)
                <option value="5" > ☆☆☆☆☆ </option>
                <option value="4" > ☆☆☆☆ </option>
                <option value="3" selected> ☆☆☆ </option>
                <option value="2" > ☆☆ </option>
                <option value="1" > ☆ </option>
                <option value="0" >  </option>
            @elseif($review->star_count == 4)
                <option value="5" > ☆☆☆☆☆ </option>
                <option value="4" selected> ☆☆☆☆ </option>
                <option value="3" > ☆☆☆ </option>
                <option value="2" > ☆☆ </option>
                <option value="1" > ☆ </option>
                <option value="0" >  </option>
            @else
                <option value="5" selected> ☆☆☆☆☆ </option>
                <option value="4" > ☆☆☆☆ </option>
                <option value="3" > ☆☆☆ </option>
                <option value="2" > ☆☆ </option>
                <option value="1" > ☆ </option>
                <option value="0" >  </option>
            @endif
            </select>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-8">                    
            @error('content')
                <strong>レビュー内容を入力してください</strong>
            @enderror
            <div class="col-12 col-md-10">
                <label for="content" class="form-label text-md-left fw-bold">内容</label>
            </div>
            <div class="col">
                <textarea class="form-control" id="comment" name="comment" cols="30" rows="5">{{$review->comment}}</textarea>                            
            </div>
            <button type="submit" class="btn tabelog-submit-button ml-2">レビュー内容を変更する</button>
        </div>
    </div>
</form>


@endsection