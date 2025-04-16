@extends('layouts.app')

@section('content')

<a href="{{ route('reviews.index') }}">戻る</a>
<form method="POST" action="{{ route('reviews.update',$review) }}">
    @csrf
    @method('PUT')

    <h4>レビュー内容</h4>
    <div class="col-auto">
        <select class="form-control" name="star_count">
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
    @error('content')
        <strong>レビュー内容を入力してください</strong>
    @enderror
    <textarea name="comment" class="form-control m-2">{{$review->comment}}</textarea>
    <button type="submit" class="btn tabelog-submit-button ml-2">編集</button>
</form>


@endsection