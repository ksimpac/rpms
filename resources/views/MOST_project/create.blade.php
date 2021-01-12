@extends('layouts.main')

@section('title')
<span>
    <h4>科技部專題研究計畫(近五年)</h4>
</span>
@endsection

@section('card-body-content')
<form action="{{ route('MOST_project.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="projectName">計畫名稱</label>
        <input type="text" class="form-control @error('projectName') is-invalid @enderror" id="projectName"
            name="projectName" value="{{ old('projectName') }}">
        @error('projectName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="startDate">執行起始日期</label>
        <input type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate"
            aria-describedby="startDateHelp" value="{{ old('startDate') }}">
        <small id="birthdayHelp" class="form-text text-muted">格式為西元年/月/日，例如1901/01/01</small>
        @error('startDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="endDate">執行結束日期</label>
        <input type="text" class="form-control @error('endDate') is-invalid @enderror" id="endDate" name="endDate"
            aria-describedby="endDateHelp" value="{{ old('endDate') }}">
        <small id="birthdayHelp" class="form-text text-muted">格式為西元年/月/日，例如1901/01/01</small>
        @error('endDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="@error('jobkind') is-invalid @enderror">
        <label for="jobkind">工作類別</label><br />
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jobkind" id="jobkind1" value="主持人"
                {{ old('jobkind') == '主持人' ? 'checked' : '' }}>
            <label class="form-check-label" for="jobkind1">
                主持人
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jobkind" id="jobkind2" value="共同主持人"
                {{ old('jobkind') == '共同主持人' ? 'checked' : '' }}>
            <label class="form-check-label" for="jobkind2">
                共同主持人
            </label>
        </div>
    </div>

    @error('jobkind')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror


    <div class="form-group">
        <label for="plantotal_money">計畫總金額</label>
        <input type="number" class="form-control @error('plantotal_money') is-invalid @enderror" id="plantotal_money"
            name="plantotal_money" value="{{ old('plantotal_money') }}">
        @error('plantotal_money')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

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
