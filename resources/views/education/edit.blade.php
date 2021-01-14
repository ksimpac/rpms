@extends('layouts.main')

@section('title')
@include('education.title')
@endsection

@section('card-body-content')
<form action="{{ route('education.update', ['id' => $collection->id, 'username' => $collection->username]) }}"
    method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @include('education.form')
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection