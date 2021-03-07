@extends('layouts.main')

@section('title')
@include('education.title')
@endsection

@section('card-body-content')
<form action="{{ route('education.update', ['id' => $collection->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @include('education.form')
    <input type="hidden" name="degree" value="{{ $collection->degree }}">
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection
