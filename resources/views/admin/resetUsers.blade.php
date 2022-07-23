@extends('layouts.main')

@section('title')
<h4>刪除報名資料</h4>
@endsection

@section('card-body-content')
<form action="{{ route('admin.resetUsers.update') }}" method="post">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <div class="alert alert-danger" role="alert">
            因個資法的關係，此動作將會刪除所有報名資料並無法還原，請謹慎操作！
        </div>
    </div>
    <button type="submit" class="btn btn-danger">刪除</button>
</form>
@endsection
