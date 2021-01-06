@extends('layouts.main')

@section('title')
<div>
    <h4>期刊論文資料管理</h4>
    <span>近五年內已發表或出版之相關著作(需收錄於SCI、SCIE、SSCI)至少2篇</span>
</div>
@endsection

@section('card-body-content')
<span>(*為選填)</span>
<form action="" method="POST">

    <div class="form-group">
        <label for="publicationName">刊物名稱</label>
        <input type="text" class="form-control" id="publicationName" name="publicationName">
        @error('publicationName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="publicationDate">年月</label>
        <input type="text" class="form-control" id="publicationDate" name="publicationDate"
            aria-describedby="publicationDateHelp">
        <small id="publicationDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('publicationDate')
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

    <div class="form-group">
        <label for="order">作者總人數</label>
        <input type="number" class="form-control" id="order" name="order">
        @error('order')
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
        <label for="thesisName">論文名稱</label>
        <input type="text" class="form-control" id="thesisName" name="thesisName">
        @error('thesisName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="type">收錄分類</label>
        <select id="type" class="form-control" name="type">
            <option value="SCI">SCI</option>
            <option value="SCIE">SCIE</option>
            <option value="SSCI">SSCI</option>
            <option value="其他">其他</option>
            @error('type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </select>
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
