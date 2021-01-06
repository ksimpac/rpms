@extends('layouts.main')

@section('title')
<span>
    <h4>科技部專題研究計畫(近五年)</h4>
</span>
@endsection

@section('card-body-content')
<span>(*為選填)</span>
<form action="" method="POST">

    <div class="form-group">
        <label for="projectName">計畫名稱</label>
        <input type="text" class="form-control" id="projectName" name="projectName">
        @error('projectName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="startDate">執行起始日期</label>
        <input type="text" class="form-control" id="startDate" name="startDate" aria-describedby="startDateHelp">
        <small id="startDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('startDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="endDate">執行結束日期</label>
        <input type="text" class="form-control" id="endDate" name="endDate" aria-describedby="endDateHelp">
        <small id="endDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('endDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <label for="jobkind">工作類別</label><br />
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jobkind" id="jobkind1" value="主持人">
        <label class="form-check-label" for="jobkind1">
            主持人
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jobkind" id="jobkind2" value="共同主持人">
        <label class="form-check-label" for="jobkind2">
            共同主持人
        </label>
    </div>

    @error('jobkind')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror


    <div class="form-group">
        <label for="plantotal_money">計畫總金額</label>
        <input type="number" class="form-control" id="plantotal_money" name="plantotal_money">
        @error('plantotal_money')
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
