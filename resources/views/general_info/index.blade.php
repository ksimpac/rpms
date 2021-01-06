@extends('layouts.main')

@section('title')
<span>
    <h4>基本資料</h4>
</span>
@endsection

@section('card-body-content')

<span class="d-flex justify-content-end"><a href="{{ route('general_info.create') }}"
        class="btn btn-secondary">新增一筆</a></span>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">英文姓名</th>
            <th scope="col">生日</th>
            <th scope="col">性別</th>
            <th scope="col">聯絡電話</th>
            <th scope="col">　</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection
