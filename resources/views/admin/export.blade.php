@extends('layouts.main')

@section('title')
@include('admin.title')
@endsection

@section('card-body-content')
<form action="#" method="post">
    @csrf
    <div class="form-group">
        <label for="startDate">起始日期</label>
        <input type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate"
            aria-describedby="startDateHelp" value="{{ old('startDate') }}">
        <small id="birthdayHelp" class="form-text text-muted">格式為西元年/月/日，例如1901/01/01</small>
        @error('startDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="endDate">結束日期</label>
        <input type="text" class="form-control @error('endDate') is-invalid @enderror" id="endDate" name="endDate"
            aria-describedby="endDateHelp" value="{{ old('endDate') }}">
        <small id="birthdayHelp" class="form-text text-muted">格式為西元年/月/日，例如1901/01/01</small>
        @error('endDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">匯出</button>
</form>
@endsection
