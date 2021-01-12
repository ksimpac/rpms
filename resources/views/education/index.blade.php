@extends('layouts.main')

@section('title')
<span>
    <h4>學歷</h4>
    <span>(大學/碩士/博士 皆須填寫)</span>
</span>
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
                <form action="{{ route('education.destroy', ['username' => $item->username]) }}" method="post">
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
