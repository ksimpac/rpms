@extends('layouts.main')

@section('title')
@include('MOST_project.title')
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('MOST_project.create') }}"
        class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">計畫名稱</th>
            <th scope="col">執行起始日期</th>
            <th scope="col">執行結束日期</th>
            <th scope="col">工作類別</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->projectName }}</td>
            <td>{{ $item->startDate }}</td>
            <td>{{ $item->endDate }}</td>
            <td>{{ $item->jobkind }}</td>
            <td>
                <form action="{{ route('MOST_project.destroy', ['id' => $item->id]) }}" method="post">
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
