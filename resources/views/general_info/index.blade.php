@extends('layouts.main')

@section('title')
@include('general_info.title')
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('general_info.create') }}"
        class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">生日</th>
            <th scope="col">性別</th>
            <th scope="col">聯絡電話</th>
            <th scope="col">教師證級別</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->birthday }}</td>
            <td>{{ $item->gender }}</td>
            <td>{{ $item->telephone }}</td>
            <td>{{ $item->teacherCertificateType }}</td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('general_info.edit', ['id' => $item->id, 'username' => $item->username]) }}"
                        class="btn btn-warning mr-2">修改</a>
                    <form action="{{ route('general_info.destroy', ['username' => $item->username]) }}" method="post">
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