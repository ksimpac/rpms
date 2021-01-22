@extends('layouts.main')

@section('title')
@include('thesis_conf.title')
@endsection

@section('card-body-content')
<form action="{{ route('thesis_conf.update', ['id' => $collection->id]) }}" method="POST" enctype="multipart/form-data">
    @include('thesis_conf.form')
    @method('PATCH')
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection
