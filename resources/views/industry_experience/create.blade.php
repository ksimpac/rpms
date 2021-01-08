@extends('layouts.main')

@section('title')
<div>
    <h4>經歷</h4>
    <span>(須具備一年(含)以上業界實務經驗或擔任產學合作計畫主持人為期至少一年)</span>
</div>
@endsection

@section('card-body-content')
<span>(*為選填)</span>
<form action="{{ route('industry_experience.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="working_units">任職單位</label>
        <input type="text" class="form-control @error('working_units') is-invalid @enderror" id="working_units"
            name="working_units" value="{{ old('working_units') }}">
        @error('working_units')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="position">職稱</label>
        <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position"
            value="{{ old('position') }}">
        @error('position')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="@error('position') is-invalid @enderror">
        <label for="type">兼專任</label><br />
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="type1" value="兼任"
                {{ old('type') == '兼任' ? 'checked' : '' }}>
            <label class="form-check-label" for="type1">
                兼任
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="type2" value="專任"
                {{ old('type') == '專任' ? 'checked' : '' }}>
            <label class="form-check-label" for="type2">
                專任
            </label>
        </div>
    </div>


    @error('type')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror


    <div class="form-group">
        <label for="job_description">工作內容</label>
        <textarea class="form-control @error('job_description') is-invalid @enderror" id="job_description"
            name="job_description" rows="3">{{ old('job_description') }}</textarea>
        @error('job_description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="startDate">任職時間起</label>
        <input type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate"
            aria-describedby="startDateHelp" value="{{ old('startDate') }}">
        <small id="startDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('startDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="endDate">任職時間迄</label>
        <input type="text" class="form-control @error('endDate') is-invalid @enderror" id="endDate" name="endDate"
            aria-describedby="endDateHelp" value="{{ old('endDate') }}">
        <small id="endDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('endDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="identification">佐證資料上傳 (如：勞工保險證明或服務證明)</label>
        <input type="file" class="form-control-file @error('identification') is-invalid @enderror" id="identification"
            name="identification" value="{{ old('identification') }}">
        @error('identification')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection
