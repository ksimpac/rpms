@extends('layouts.main')

@section('title')
<span>
    <h4>學歷</h4>
</span>
@endsection

@section('card-body-content')
<span>(*為選填)</span>
<form action="" method="POST">

    <div class="form-group">
        <label for="schoolName">學校名</label>
        <input type="text" class="form-control" id="schoolName" name="schoolName">
        @error('schoolName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="department">院系科名</label>
        <input type="text" class="form-control" id="department" name="department">
        @error('department')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="startDate">修業年月起</label>
        <input type="text" class="form-control" id="startDate" name="startDate" aria-describedby="startDateHelp">
        <small id="startDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('startDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="endDate">修業年月迄</label>
        <input type="text" class="form-control" id="endDate" name="endDate" aria-describedby="endDateHelp">
        <small id="endDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('endDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="degree">學位</label>
        <select id="degree" class="form-control" name="degree">
            <option value="大學">大學</option>
            <option value="碩士">碩士</option>
            <option value="博士">博士</option>
            @error('degree')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </select>
    </div>

    <div class="form-group">
        <label for="status">修業狀況</label>
        <select id="status" class="form-control" name="status">
            <option value="畢業">畢業</option>
            <option value="結業">結業</option>
            <option value="肆業">肆業</option>
            @error('status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </select>
    </div>

    <div class="form-group">
        <label for="country">畢業國家</label>
        <input type="text" class="form-control" id="country" name="country">
        @error('country')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="thesis">畢業論文 (大學免填)</label>
        <input type="text" class="form-control" id="thesis" name="thesis">
        @error('thesis')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="advisor">指導教授 (大學免填)</label>
        <input type="text" class="form-control" id="advisor" name="advisor">
        @error('advisor')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="certificate">畢業證書上傳</label>
        <input type="file" class="form-control-file" id="certificate" name="certificate">
        @error('certificate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="transcript">成績單上傳*</label>
        <input type="file" class="form-control-file" id="transcript" name="transcript">
        @error('transcript')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection
