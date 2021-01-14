@extends('layouts.main')

@section('title')
@include('MOST_project.title')
@endsection

@section('card-body-content')
<form action="{{ route('MOST_project.store') }}" method="POST" enctype="multipart/form-data">
    @include('MOST_project.form')
    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection