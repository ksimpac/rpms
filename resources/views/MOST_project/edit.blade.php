@extends('layouts.main')

@section('title')
@include('most_project.title')
@endsection

@section('card-body-content')
<form action="{{ route('most_project.update', ['id' => $collection->id]) }}" method="POST"
    enctype="multipart/form-data">
    @include('most_project.form')
    @method('PATCH')
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection
