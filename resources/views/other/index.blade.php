@extends('layouts.main')

@section('title')
@include('other.title')
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('other.create') }}" class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">佐證資料上傳</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td><a href="{{ Storage::url('other/' . $item->identification) }}"
                    target="_blank">{{ $item->identification }}</a></td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('other.edit', ['id' => $item->id, 'username' => $item->username]) }}"
                        class="btn btn-warning mr-2">修改</a>
                    <form action="{{ route('other.destroy', ['id' => $item->id]) }}" method="post">
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