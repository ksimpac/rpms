@extends('layouts.main')

@section('title')
<div>
    <h4>期刊論文資料管理</h4>
    <span>近五年內已發表或出版之相關著作(需收錄於SCI、SCIE、SSCI)至少2篇</span>
</div>
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
