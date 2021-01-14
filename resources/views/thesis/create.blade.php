@extends('layouts.main')

@section('title')
@include('thesis.title')
@endsection

@section('card-body-content')
<form action="{{ route('thesis.store') }}" method="POST" enctype="multipart/form-data">
    @include('thesis.form')
    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection