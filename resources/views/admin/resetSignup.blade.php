@extends('layouts.main')

@section('title')
<h4>重新開放報名</h4>
@endsection

@section('card-body-content')
<form action="{{ route('admin.resetSignup.update') }}" method="post">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <div class="alert alert-danger" role="alert">
            此動作過後將無法還原，請謹慎操作！
        </div>
    </div>
    <button type="submit" class="btn btn-warning">設定</button>
</form>
@endsection
