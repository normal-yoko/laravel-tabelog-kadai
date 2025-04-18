@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4" style="font-family: 'Comic Sans MS', cursive, sans-serif; color: #4CAF50;">レビュー一覧</h2>

    <table class="table table-striped" style="background-color: #f9f9f9; border-radius: 10px; border: 1px solid #ddd;">
        <thead>
            <tr>
                <th scope="col">店舗名</th>
                <th scope="col">星の数</th>
                <th scope="col">コメント</th>
                <th scope="col">更新日時</th>
                <th scope="col" class="text-center">編集</th>
                <th scope="col" class="text-center">削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
            <tr style="border-bottom: 1px solid #ddd;">
                <td>{{ $review->store->name }}</td>
                <td>{{ str_repeat('☆', $review->star_count) }}</td>
                <td>{{ $review->comment }}</td>
                <td>{{ $review->updated_at }}</td>
                <td class="text-center">
                    <form action="{{ route('reviews.edit', $review) }}" method="GET" style="display:inline;">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-warning" style="border-radius: 5px; background-color: #FFBC00; color: white; padding: 5px 10px; font-family: 'Comic Sans MS', cursive, sans-serif;">
                            編集
                        </button>
                    </form>
                </td>
                <td class="text-center">
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')" class="btn btn-danger" style="border-radius: 5px; background-color: #FF5733; color: white; padding: 5px 10px; font-family: 'Comic Sans MS', cursive, sans-serif;">
                            削除
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
