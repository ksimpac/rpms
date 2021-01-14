@extends('layouts.main')

@section('title')
@include('industry_experience.title')
@endsection

@section('card-body-content')
<form action="{{ route('industry_experience.store') }}" method="POST" enctype="multipart/form-data">
    @include('industry_experience.form')
    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection