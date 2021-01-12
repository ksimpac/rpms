@extends('layouts.main')

@section('title')
<div>
    <h4>期刊論文</h4>
    <span>近五年內已發表或出版之相關著作(需收錄於SCI、SCIE、SSCI)至少2篇</span>
</div>
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('thesis.create') }}"
        class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">刊物名稱</th>
            <th scope="col">年月</th>
            <th scope="col">作者順序</th>
            <th scope="col">收錄分類</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->publicationName }}</td>
            <td>{{ $item->publicationDate }}</td>
            <td>{{ $item->order }}</td>
            <td>{{ $item->type }}</td>
            <td>
                <form action="{{ route('thesis.destroy', ['id' => $item->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
