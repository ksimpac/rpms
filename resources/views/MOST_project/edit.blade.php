@extends('layouts.main')

@section('title')
@include('MOST_project.title')
@endsection

@section('card-body-content')
<form action="{{ route('MOST_project.update', ['id' => $collection->id, 'username' => $collection->username]) }}"
    method="POST" enctype="multipart/form-data">
    @include('MOST_project.form')
    @method('PATCH')
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection
