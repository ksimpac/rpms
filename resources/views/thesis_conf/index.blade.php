@extends('layouts.main')

@section('title')
    @include('thesis_conf.title')
@endsection

@section('card-body-content')

@can('create', App\Thesis_conf::class)
    <span class="d-flex justify-content-end"><a href="{{ route('thesis_conf.create') }}"
        class="btn btn-secondary">新增一筆</a></span>
@endcan

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">研討會名稱</th>
            <th scope="col">論文名稱</th>
            <th scope="col">發表年份</th>
            <th scope="col">作者總人數</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->conf_name }}</td>
            <td>{{ $item->thesisName }}</td>
            <td>{{ $item->years }}</td>
            <td>{{ $item->authorNo }}</td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('thesis_conf.show', ['thesis_conf' => $item->id]) }}" class="btn btn-info mr-2">檢視</a>

                    @can('update', $item)
                        <a href="{{ route('thesis_conf.edit', ['thesis_conf' => $item->id]) }}" class="btn btn-warning mr-2">修改</a>
                    @endcan

                    @can('delete', $item)
                        <form action="{{ route('thesis_conf.destroy', ['thesis_conf' => $item->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger delete-confirm">刪除</button>
                        </form>
                    @endcan
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
