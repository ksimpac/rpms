@extends('layouts.main')

@section('title')
@include('industry_experience.title')
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('industry_experience.create') }}"
        class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">任職單位</th>
            <th scope="col">職稱</th>
            <th scope="col">任職時間起</th>
            <th scope="col">任職時間迄</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->working_units }}</td>
            <td>{{ $item->position }}</td>
            <td>{{ $item->startDate }}</td>
            <td>{{ $item->endDate }}</td>
            <td>
                <form action="{{ route('industry_experience.destroy', ['id' => $item->id]) }}" method="post">
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
