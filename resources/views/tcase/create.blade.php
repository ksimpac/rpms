@extends('layouts.main')

@section('title')
@include('tcase.title')
@endsection

@section('card-body-content')
<form action="{{ route('tcase.store') }}" method="POST" enctype="multipart/form-data">
    @include('tcase.form')
    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection