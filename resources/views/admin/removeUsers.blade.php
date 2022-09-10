@extends('layouts.main')

@section('title')
<h4>刪除報名資料</h4>
@endsection

@section('card-body-content')
<div class="form-group">
    <div class="alert alert-danger" role="alert">
        刪除過後選取之使用者的報名資料皆無法復原，請謹慎操作！
    </div>
</div>

<div class="form-group">
    <form action="{{ route('admin.removeUsers.removeSelectedUsers') }}" method="post">
        @csrf
        @method('DELETE')
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">姓名</th>
                    <th scope="col">帳號</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">是否報名</th>
                    <th scope="col">註冊帳號時間</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td><input type="checkbox" name="user[{{ $user->id }}]"></td>
                    <td>{{ $user->chineseName }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->isSignup === 1 ? '是' : '否' }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-outline-danger delete-confirm">刪除勾選使用者</button>
    </form>
</div>

{{ $users->links() }} <hr />

<div class="form-group">
    <div class="alert alert-danger" role="alert">
        刪除過後所有使用者的報名資料皆無法復原，請謹慎操作！
    </div>
</div>

<div class="from-group">
    <form action="{{ route('admin.removeUsers.delete') }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger delete-confirm">刪除所有使用者</button>
    </form>
</div>
@endsection
