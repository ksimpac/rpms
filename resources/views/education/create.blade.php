@extends('layouts.main')

@section('title')
@include('education.title')
@endsection

@section('card-body-content')
<form action="{{ route('education.store') }}" method="POST" enctype="multipart/form-data">
    @include('education.form')
    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection
