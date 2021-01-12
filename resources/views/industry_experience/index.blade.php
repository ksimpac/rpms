@extends('layouts.main')

@section('title')
<div>
    <h4>經歷</h4>
    <span>(須具備一年(含)以上業界實務經驗或擔任產學合作計畫主持人為期至少一年)</span>
</div>
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
