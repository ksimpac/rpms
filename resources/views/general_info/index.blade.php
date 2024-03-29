@extends('layouts.main')

@section('title')
    @include('general_info.title')
@endsection

@section('card-body-content')

@can('create', App\General_info::class)
    <span class="d-flex justify-content-end"><a href="{{ route('general_info.create') }}"
        class="btn btn-secondary">新增一筆</a></span>
@endcan

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">英文姓氏</th>
            <th scope="col">英文名字</th>
            <th scope="col">教師證級別</th>
            <th scope="col">教師證影本</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->englishLastName }}</td>
            <td>{{ $item->englishFirstName }}</td>
            <td>{{ $item->teacherCertificateType }}</td>
            <td>
                @if(isset($item->teacherCertificateFiles))
                    <a href="{{ url(Storage::url('general_info/' . $item->teacherCertificateFiles . '.pdf')) }}"
                        target="_blank">{{ $item->teacherCertificateFiles }}</a>
                @else
                    無
                @endif
            </td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('general_info.show', ['general_info' => $item->id]) }}" class="btn btn-info mr-2">檢視</a>
                    @can('update', $item)
                        <a href="{{ route('general_info.edit', ['general_info' => $item->id]) }}" class="btn btn-warning mr-2">修改</a>
                    @endcan

                    @can('delete', $item)
                        <form action="{{ route('general_info.destroy', ['general_info' => $item->id]) }}" method="post">
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
