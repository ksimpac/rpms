@extends('layouts.main')

@section('title')
    @include('industry_experience.title')
@endsection

@section('card-body-content')

@can('create', App\Industry_experience::class)
    <span class="d-flex justify-content-end"><a href="{{ route('industry_experience.create') }}"
        class="btn btn-secondary">新增一筆</a></span>
@endcan

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">任職單位</th>
            <th scope="col">職稱</th>
            <th scope="col">專兼任</th>
            <th scope="col">佐證資料</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->working_units }}</td>
            <td>{{ $item->position }}</td>
            <td>{{ $item->type }}</td>
            <td><a href="{{ url(Storage::url('industry_experience/' . $item->identification . '.pdf')) }}"
                    target="_blank">{{ $item->identification }}</a></td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('industry_experience.show', ['industry_experience' => $item->id]) }}"
                        class="btn btn-info mr-2">檢視</a>
                    @can('update', $item)
                        <a href="{{ route('industry_experience.edit', ['industry_experience' => $item->id]) }}"
                            class="btn btn-warning mr-2">修改</a>
                    @endcan

                    @can('delete', $item)
                        <form action="{{ route('industry_experience.destroy', ['industry_experience' => $item->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">刪除</button>
                        </form>
                    @endcan
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
