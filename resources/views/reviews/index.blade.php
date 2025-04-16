
@extends('layouts.app')

@section('content')

<div>
        <a href="{{ route('stores.index') }}">戻る</a>
</div>

<table>   
   <tr>
        <th>店舗名</th>
        <th>星の数</th>
        <th>コメント</th>
        <th>更新日時</th>
        <th></th>
        <th></th>

   </tr>
   @foreach ($reviews as $review)
   <tr>
       <td>{{ $review->store->name }}</td>
       <td>{{ str_repeat('☆',$review->star_count) }}</td>
       <td>{{ $review->comment }}</td>
       <td>{{ $review->updated_at }}</td>
       <td>
       <form action="{{ route('reviews.edit', $review) }}" method="GET" style="display:inline;">
                @csrf
                @method('GET')
                <button type="submit" onclick="return ">編集</button>
            </form>
        </td>
        </td>
        <td>
        <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </td>
   </tr>
    <form>

    </form>
   @endforeach
</table>
@endsection