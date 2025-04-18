@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4">予約一覧</h2>
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">店舗名</th>
                <th scope="col">予約日</th>
                <th scope="col">予約時間</th>
                <th scope="col">人数</th>
                <th scope="col">更新日時</th>
                <th scope="col" colspan="2" class="text-center">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reserves as $reserve)
                <tr>
                    <td>{{ $reserve->store->name }}</td>
                    <td>{{ $reserve->reservation_date }}</td>
                    <td>{{ $reserve->reservation_time }}</td>
                    <td>{{ $reserve->headcount }}</td>
                    <td>{{ $reserve->updated_at }}</td>
                    <td class="text-center">
                        @if($current_date >= $reserve->reservation_date)
                            <span class="badge bg-warning text-dark">予約日が当日以降修正不可</span>
                        @else
                            <form action="{{ route('reserves.edit', $reserve->id) }}" method="GET" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-info btn-sm">予約内容変更</button>
                            </form>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($current_date >= $reserve->reservation_date)
                            <span class="badge bg-danger text-white">予約日が当日以降キャンセル不可</span>
                        @else
                            <form action="{{ route('reserves.destroy', $reserve->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当にキャンセルしますか？')">キャンセル</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
