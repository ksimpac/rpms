@extends('layouts.main')

@section('title')
@include('industry_experience.title')
@endsection

@section('card-body-content')
<form action="#">
    <div class="form-group row">
        <label for="staticWorking_units" class="col-sm-2 col-form-label">任職單位</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticWorking_units"
                value="{{ $industry_experience->working_units }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticPosition" class="col-sm-2 col-form-label">職稱</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticPosition"
                value="{{ $industry_experience->position }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticType" class="col-sm-2 col-form-label">兼專任</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticType" value="{{ $industry_experience->type }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticJob_description" class="col-sm-2 col-form-label">工作內容</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticJob_description"
                value="{{ $industry_experience->job_description }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticStartDate" class="col-sm-2 col-form-label">任職時間起</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticStartDate"
                value="{{ $industry_experience->startDate }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticEndDate" class="col-sm-2 col-form-label">任職時間迄</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEndDate"
                value="{{ $industry_experience->endDate }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticIdentification" class="col-sm-2 col-form-label">佐證資料上傳</label>
        <div class="col-sm-10">
            <a href="{{ url(Storage::url('industry_experience/' . $industry_experience->identification)) }}" target="_blank"
                class="form-control-plaintext">{{ $industry_experience->identification }}</a>
        </div>
    </div>
</form>
@endsection
