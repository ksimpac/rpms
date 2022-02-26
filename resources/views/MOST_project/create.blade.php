@extends('layouts.main')

@section('title')
@include('most_project.title')
@endsection

@section('card-body-content')
<form action="{{ route('most_project.store') }}" method="POST" enctype="multipart/form-data">
    @include('most_project.form')
    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection
