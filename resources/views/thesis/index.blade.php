@extends('layouts.main')

@section('title')
<span>
    <h4>期刊論文資料管理</h4>
</span>
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('thesis.create') }}"
        class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">刊物名稱</th>
            <th scope="col">年月</th>
            <th scope="col">作者總人數</th>
            <th scope="col">作者順序</th>
            <th scope="col">　</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
