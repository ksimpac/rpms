@extends('layouts.main')

@section('title')
<h4>設定截止日期</h4>
@endsection

@section('card-body-content')
<form action="{{ route('admin.deadline.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="deadline">截止日期</label>
        <input type="text" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline"
            aria-describedby="deadlineHelp" value="{{ old('deadline') }}">
        @error('deadline')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    @if (Session::has('success'))
    <div class="form-group row">
        <div class="alert alert-success col-md-6 offset-md-4" role="alert">
            {{ Session::get('success') }}
        </div>
    </div>
    @endif

    <button type="submit" class="btn btn-primary">設定</button>
</form>

<script>
    var param = {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        locale: "zh_tw"
    };

    document.getElementById('deadline').flatpickr(param);
</script>
@endsection
