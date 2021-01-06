@extends('layouts.main')

@section('title')
<span>
    <h4>經歷</h4>
</span>
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
            <th scope="col">專兼任</th>
            <th scope="col">工作內容</th>
            <th scope="col">　</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
