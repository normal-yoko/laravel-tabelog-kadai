@extends('layouts.app')

@section('content')

<table>   
   <tr>
        <th>店舗名</th>
        <th>予約日</th>
        <th>予約時間</th>
        <th>人数</th>
        <th>更新日時</th>
        <th></th>
        <th></th>
   </tr>
   @foreach ($reserves as $reserve)
    <tr>
        <td>{{ $reserve->store->name }}</td>
        <td>{{ $reserve->reservation_date }}</td>
        <td>{{ $reserve->reservation_time }}</td>
        <td>{{ $reserve->headcount }}</td>
        <td>{{ $reserve->updated_at }}</td>
        <td>
            @if($current_date >= $reserve->reservation_date)
                <label >予約日が当日以降修正不可</label>
            @else
                <form action="{{ route('reserves.edit', $reserve->id) }}" method="GET" style="display:inline;">
                    @csrf
                    <button type="submit">予約内容変更</button>
                </form>                
            @endif
        </td>
        <td>
            @if($current_date >= $reserve->reservation_date)
                <label >予約日が当日以降キャンセル不可</label>
            @else
                <form action="{{ route('reserves.destroy', $reserve->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当にキャンセルしますか？')">キャンセル</button>
                </form>
            @endif
        </td>
    </tr>
   @endforeach
</table>

@endsection