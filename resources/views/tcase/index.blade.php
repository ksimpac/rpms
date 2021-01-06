@extends('layouts.main')

@section('title')
<span>
    <h4>產學合作計畫參與</h4>
</span>
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('tcase.create') }}" class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">計畫名稱</th>
            <th scope="col">合作機構名稱</th>
            <th scope="col">執行結束日期</th>
            <th scope="col">工作類別</th>
            <th scope="col">　</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
