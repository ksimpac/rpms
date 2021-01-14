@extends('layouts.main')

@section('title')
@include('general_info.title')
@endsection

@section('card-body-content')
<form action="{{ route('general_info.store') }}" method="POST" enctype="multipart/form-data">
    @include('general_info.form')
    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection