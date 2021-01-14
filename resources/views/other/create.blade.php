@extends('layouts.main')

@section('title')
@include('other.title')
@endsection

@section('card-body-content')
<form action="{{ route('other.store') }}" method="POST" enctype="multipart/form-data">
    @include('other.form')
    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection