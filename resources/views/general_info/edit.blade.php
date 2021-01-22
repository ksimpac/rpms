@extends('layouts.main')

@section('title')
@include('general_info.title')
@endsection

@section('card-body-content')
<form action="{{ route('general_info.update', ['id' => $collection->id]) }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @include('general_info.form')
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection
