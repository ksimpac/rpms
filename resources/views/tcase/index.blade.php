@extends('layouts.main')

@section('title')
@include('tcase.title')
@endsection

@section('card-body-content')

@if(Auth::user()->isSignup == 0)
<span class="d-flex justify-content-end"><a href="{{ route('tcase.create') }}" class="btn btn-secondary">新增一筆</a></span>
@endif

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">計畫名稱</th>
            <th scope="col">合作機構名稱</th>
            <th scope="col">執行結束日期</th>
            <th scope="col">佐證資料</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->projectName }}</td>
            <td>{{ $item->collaboration_name }}</td>
            <td>{{ $item->endDate }}</td>
            <td><a href="{{ url(Storage::url('tcase/' . $item->identification)) }}"
                    target="_blank">{{ $item->identification }}</a></td>

            <td>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('tcase.show', ['id' => $item->id]) }}" class="btn btn-info mr-2">檢視</a>
                    @if(Auth::user()->isSignup == 0)
                    <a href="{{ route('tcase.edit', ['id' => $item->id]) }}" class="btn btn-warning mr-2">修改</a>
                    <form action="{{ route('tcase.destroy', ['id' => $item->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">刪除</button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
