
@extends('layouts.app')

@section('content')
<table>   
   <tr>
       <th>ユーザー名</th>
       <th>星の数</th>
       <th>コメント</th>
       <th>{{$id}}</th>
   </tr>
   @foreach ($reviews as $review)
   <tr>
       <td>{{ $review->comment }}</td>
       <td>{{ str_repeat('*',$review->star_count) }}</td>
       <td>{{ $review->comment }}</td>
       <td>{{ $review->updated_at }}</td>
   </tr>
   @endforeach
</table>
@endsection