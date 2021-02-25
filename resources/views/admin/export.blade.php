@extends('layouts.main')

@section('title')
<h4>匯出資料</h4>
@endsection

@section('card-body-content')
<form action="{{ route('admin.export') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="startDate">起始日期</label>
        <input type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate"
            aria-describedby="startDateHelp" value="{{ old('startDate') }}">
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
        @error('endDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">匯出</button>
</form>

<script>
    var param = {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        locale: "zh_tw"
    };

    document.getElementById('startDate').flatpickr(param);
    document.getElementById('endDate').flatpickr(param);
</script>
@endsection
