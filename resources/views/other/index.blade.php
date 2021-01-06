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
            <th scope="col">　</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
