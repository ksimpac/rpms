@extends('layouts.main')

@section('title')
    @include('other.title')
@endsection

@section('card-body-content')

@can('create', App\Other::class)
    <span class="d-flex justify-content-end"><a href="{{ route('other.create') }}" class="btn btn-secondary">新增一筆</a></span>
@endcan

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">佐證資料上傳</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td><a href="{{ url(Storage::url('other/' . $item->identification . '.pdf')) }}"
                    target="_blank">{{ $item->identification }}</a></td>
            <td>
                <div class="d-flex justify-content-start">
                    @can('update', $item)
                        <a href="{{ route('other.edit', ['other' => $item->id]) }}" class="btn btn-warning mr-2">修改</a>
                    @endcan

                    @can('delete', $item)
                        <form action="{{ route('other.destroy', ['other' => $item->id]) }}" method="post">
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
