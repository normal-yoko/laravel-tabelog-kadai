
@extends('layouts.app')

@section('content')

<div>
        <a href="{{ route('stores.show',$store) }}">戻る</a>
</div>

<table>   
   <tr>
       <th>ユーザー名</th>
       <th>星の数</th>
       <th>コメント</th>
       <th>更新日時</th>
   </tr>
   @foreach ($reviews as $review)
   <tr>
       <td>{{ $review->user->name }}</td>
       <td>{{ str_repeat('☆',$review->star_count) }}</td>
       <td>{{ $review->comment }}</td>
       <td>{{ $review->updated_at }}</td>
   </tr>
   @endforeach
</table>
@endsection