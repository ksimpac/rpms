@extends('layouts.main')

@section('title')
<h4>註冊管理員帳號</h4>
@endsection

@section('card-body-content')
<form action="{{ route('admin.register.store') }}" method="post">
    @csrf

    <div class="form-group row">
        <label for="username" class="col-md-4 col-form-label text-md-right">帳號</label>

        <div class="col-md-6">
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                name="username" value="{{ old('username') }}" required autocomplete="off">

            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="chineseName" class="col-md-4 col-form-label text-md-right">中文姓名</label>

        <div class="col-md-6">
            <input id="chineseName" type="text" class="form-control @error('chineseName') is-invalid @enderror"
                name="chineseName" value="{{ old('chineseName') }}" required autocomplete="off" autofocus>

            @error('chineseName')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    @if (Session::has('success'))
    <div class="form-group row">
        <div class="alert alert-success col-md-6 offset-md-4" role="alert">
            {{ Session::get('success') }}
        </div>
    </div>
    @endif

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </div>
</form>
@endsection
