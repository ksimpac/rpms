@extends('layouts.main')

@section('title')
<div>
    <h4>其他有助審查資料</h4>
    <span>(如專利、獲獎、專業證照、語文能力、其他計畫、學生輔導等)</span>
</div>
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('other.create') }}" class="btn btn-secondary">新增一筆</a></span>

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
            <td><a href="{{ Storage::url('other/' . $item->identification) }}"
                    target="_blank">{{ $item->identification }}</a></td>
            <td>
                <form action="{{ route('other.destroy', ['id' => $item->id]) }}" method="post">
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
