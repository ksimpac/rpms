@extends('layouts.main')

@section('title')
@include('education.title')
@endsection

@section('card-body-content')
<form action="#">
    <div class="form-group row">
        <label for="staticSchoolName" class="col-sm-2 col-form-label">學校名</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticSchoolName"
                value="{{ $collection->schoolName }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticDepartment" class="col-sm-2 col-form-label">院系科名</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticDepartment"
                value="{{ $collection->department }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticStartDate" class="col-sm-2 col-form-label">修業年月起</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticStartDate"
                value="{{ $collection->startDate }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticEndDate" class="col-sm-2 col-form-label">修業年月迄</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEndDate"
                value="{{ $collection->endDate }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticDegree" class="col-sm-2 col-form-label">學位</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticDegree"
                value="{{ $collection->degree }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticStatus" class="col-sm-2 col-form-label">修業狀況</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticStatus"
                value="{{ $collection->status }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticCountry" class="col-sm-2 col-form-label">畢業國家</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticCountry"
                value="{{ $collection->country }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticThesis" class="col-sm-2 col-form-label">畢業論文</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticThesis"
                value="{{ $collection->thesis ?? '無' }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticAdvisor" class="col-sm-2 col-form-label">指導教授</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticAdvisor"
                value="{{ $collection->advisor ?? '無' }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticCertificate" class="col-sm-2 col-form-label">畢業證書</label>
        <div class="col-sm-10">
            <a href="{{ url(Storage::url('education/certificate/' . $collection->certificate)) }}" target="_blank"
                class="form-control-plaintext">{{ $collection->certificate }}</a>
        </div>
    </div>

    <div class="form-group row">
        <label for="staticTranscript" class="col-sm-2 col-form-label">成績單</label>
        <div class="col-sm-10">
            <a href="{{ url(Storage::url('education/transcript/' . $collection->transcript)) }}" target="_blank"
                class="form-control-plaintext">{{ $collection->transcript }}</a>
        </div>
    </div>
    </div>
</form>
@endsection
