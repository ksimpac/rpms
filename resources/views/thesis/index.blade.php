@extends('layouts.main')

@section('title')
@include('thesis.title')
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
            <th scope="col">收錄分類</th>
            <th scope="col">佐證資料</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->publicationName }}</td>
            <td>{{ $item->publicationDate }}</td>
            <td>{{ $item->type }}</td>
            <td><a href="{{ Storage::url('thesis/' . $item->identification) }}"
                    target="_blank">{{ $item->identification }}</a></td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('thesis.show', ['id' => $item->id]) }}" class="btn btn-info mr-2">檢視</a>
                    <a href="{{ route('thesis.edit', ['id' => $item->id]) }}" class="btn btn-warning mr-2">修改</a>
                    <form action="{{ route('thesis.destroy', ['id' => $item->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">刪除</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
