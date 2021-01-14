@extends('layouts.main')

@section('title')
@include('other.title')
@endsection

@section('card-body-content')
<form action="{{ route('other.update', ['id' => $collection->id, 'username' => $collection->username]) }}" method="POST"
    enctype="multipart/form-data">
    @include('other.form')
    @method('PATCH')
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection
