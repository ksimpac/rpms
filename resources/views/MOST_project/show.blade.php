@extends('layouts.main')

@section('title')
@include('most_project.title')
@endsection

@section('card-body-content')
<form action="#">
    <div class="form-group row">
        <label for="staticProjectName" class="col-sm-2 col-form-label">計畫名稱</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticprojectName"
                value="{{ $most_project->projectName }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticStartDate" class="col-sm-2 col-form-label">執行起始日期</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticStartDate"
                value="{{ $most_project->startDate }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticEndDate" class="col-sm-2 col-form-label">執行結束日期</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEndDate"
                value="{{ $most_project->endDate }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticJobkind" class="col-sm-2 col-form-label">工作類別</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticJobkind"
                value="{{ $most_project->jobkind }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticPlantotal_money" class="col-sm-2 col-form-label">計畫總金額</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticPlantotal_money"
                value="{{ $most_project->plantotal_money }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticIdentification" class="col-sm-2 col-form-label">佐證資料上傳</label>
        <div class="col-sm-10">
            <a href="{{ url(Storage::url('most_project/' . $most_project->identification)) }}" target="_blank"
                class="form-control-plaintext">{{ $most_project->identification }}</a>
        </div>
    </div>
</form>
@endsection
