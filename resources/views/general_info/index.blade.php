@extends('layouts.main')

@section('title')
<span>
    <h4>基本資料</h4>
</span>
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('general_info.create') }}"
        class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">英文姓名</th>
            <th scope="col">生日</th>
            <th scope="col">性別</th>
            <th scope="col">聯絡電話</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->englishName }}</td>
            <td>{{ $item->birthday }}</td>
            <td>{{ $item->gender }}</td>
            <td>{{ $item->telephone }}</td>
            <td>
                <form action="{{ route('general_info.destroy', ['username' => $item->username]) }}" method="post">
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
