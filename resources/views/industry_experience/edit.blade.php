@extends('layouts.main')

@section('title')
@include('industry_experience.title')
@endsection

@section('card-body-content')
<form action="{{ route('industry_experience.update', ['id' => $collection->id]) }}" method="POST"
    enctype="multipart/form-data">
    @include('industry_experience.form')
    @method('PATCH')
    <button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection
