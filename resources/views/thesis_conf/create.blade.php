@extends('layouts.main')

@section('title')
<span>
    <h4>研討會論文(近五年)</h4>
</span>
@endsection

@section('card-body-content')
<span>(*為選填)</span>
<form action="" method="POST">

    <div class="form-group">
        <label for="conf_name">研討會名稱</label>
        <input type="text" class="form-control" id="conf_name" name="conf_name">
        @error('conf_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="thesisName">論文名稱</label>
        <input type="text" class="form-control" id="thesisName" name="thesisName">
        @error('thesisName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="years">發表年份</label>
        <input type="number" class="form-control" id="years" name="years">
        @error('years')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="authorNo">作者總人數</label>
        <input type="number" class="form-control" id="authorNo" name="authorNo">
        @error('authorNo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <label for="corresponding_author">是否為通訊作者</label><br />
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="corresponding_author" id="corresponding_author1" value="0">
        <label class="form-check-label" for="corresponding_author1">
            否
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="corresponding_author" id="corresponding_author2" value="1">
        <label class="form-check-label" for="corresponding_author2">
            是
        </label>
    </div>

    @error('corresponding_author')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    <div class="form-group">
        <label for="country">舉行之國家/城市</label>
        <input type="text" class="form-control" id="country" name="country">
        @error('country')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="identification">佐證資料上傳</label>
        <input type="file" class="form-control-file" id="identification" name="identification">
        @error('identification')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection
