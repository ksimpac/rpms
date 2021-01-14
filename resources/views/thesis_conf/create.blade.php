@extends('layouts.main')

@section('title')
@include('thesis_conf.title')
@endsection

@section('card-body-content')
<form action="{{ route('thesis_conf.store') }}" method="POST" enctype="multipart/form-data">
    @include('thesis_conf.form')
    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection