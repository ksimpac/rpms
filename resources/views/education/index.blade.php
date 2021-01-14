@extends('layouts.main')

@section('title')
@include('education.title')
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('education.create') }}"
        class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">學校名</th>
            <th scope="col">院系科名</th>
            <th scope="col">學位</th>
            <th scope="col">修業狀況</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->schoolName }}</td>
            <td>{{ $item->department }}</td>
            <td>{{ $item->degree }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('education.edit', ['id' => $item->id, 'username' => $item->username]) }}"
                        class="btn btn-warning mr-2">修改</a>
                    <form action="{{ route('education.destroy', ['username' => $item->username]) }}" method="post">
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