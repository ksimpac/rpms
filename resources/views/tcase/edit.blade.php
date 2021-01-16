@extends('layouts.main')

@section('title')
@include('tcase.title')
@endsection

@section('card-body-content')
<form action="{{ route('tcase.update', ['id' => $collection->id, 'username' => $collection->username]) }}" method="POST"
    enctype="multipart/form-data">
    @include('tcase.form')
    @method('PATCH')
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection