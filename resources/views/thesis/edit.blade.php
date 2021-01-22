@extends('layouts.main')

@section('title')
@include('thesis.title')
@endsection

@section('card-body-content')
<form action="{{ route('thesis.update', ['id' => $collection->id]) }}" method="POST" enctype="multipart/form-data">
    @include('thesis.form')
    @method('PATCH')
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection
