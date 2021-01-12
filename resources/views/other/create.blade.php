@extends('layouts.main')

@section('title')
<span>
    <h4>其他有助審查資料</h4>
    <span>(如專利、獲獎、專業證照、語文能力、其他計畫、學生輔導等)</span>
</span>
@endsection

@section('card-body-content')
<form action="{{ route('other.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="identification">佐證資料上傳(PDF檔案)</label>
        <input type="file" class="form-control-file @error('identification') is-invalid @enderror" id="identification"
            name="identification">
        @error('identification')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection
