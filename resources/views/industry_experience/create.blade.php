@extends('layouts.main')

@section('title')
<span>
    <h4>經歷</h4>
</span>
@endsection

@section('card-body-content')
<span>(*為選填)</span>
<form action="" method="POST">

    <div class="form-group">
        <label for="working_units">任職單位</label>
        <input type="text" class="form-control" id="working_units" name="working_units">
        @error('working_units')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="position">職稱</label>
        <input type="text" class="form-control" id="position" name="position">
        @error('position')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <label for="type">兼專任</label><br />
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="type" id="type1" value="兼任">
        <label class="form-check-label" for="type1">
            兼任
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="type" id="type2" value="專任">
        <label class="form-check-label" for="type2">
            專任
        </label>
    </div>

    @error('type')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror


    <div class="form-group">
        <label for="job_description">工作內容</label>
        <textarea class="form-control" id="job_description" name="job_description" rows="3"></textarea>
        @error('job_description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="startDate">任職時間起</label>
        <input type="text" class="form-control" id="startDate" name="startDate" aria-describedby="startDateHelp">
        <small id="startDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('startDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="endDate">任職時間迄</label>
        <input type="text" class="form-control" id="endDate" name="endDate" aria-describedby="endDateHelp">
        <small id="endDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('endDate')
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
