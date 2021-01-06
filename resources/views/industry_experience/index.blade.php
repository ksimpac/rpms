@extends('layouts.main')

@section('title')
<div>
    <h4>經歷</h4>
    <span>(須具備一年(含)以上業界實務經驗或擔任產學合作計畫主持人為期至少一年)</span>
</div>
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
