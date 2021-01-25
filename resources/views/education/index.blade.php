@extends('layouts.main')

@section('title')
@include('education.title')
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
            <th scope="col">畢業證書/口試證明</th>
            <th scope="col">成績單</th>
            <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collection as $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $item->schoolName }}</td>
            <td>{{ $item->department }}</td>
            <td><a href="{{ url(Storage::url('education/certificate/' . $item->certificate)) }}"
                    target="_blank">{{ $item->certificate }}</a></td>
            <td><a href="{{ url(Storage::url('education/transcript/' . $item->transcript)) }}"
                    target="_blank">{{ $item->transcript }}</a></td>
            <td>
                <div class="d-flex justify-content-start">
                    <a href="{{ route('education.show', ['id' => $item->id]) }}" class="btn btn-info mr-2">檢視</a>
                    <a href="{{ route('education.edit', ['id' => $item->id]) }}" class="btn btn-warning mr-2">修改</a>
                    <form action="{{ route('education.destroy', ['id' => $item->id]) }}" method="post">
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
