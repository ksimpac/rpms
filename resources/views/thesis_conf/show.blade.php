@extends('layouts.main')

@section('title')
@include('thesis_conf.title')
@endsection

@section('card-body-content')
<form action="#">
    <div class="form-group row">
        <label for="staticConf_name" class="col-sm-2 col-form-label">研討會名稱</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticconf_name"
                value="{{ $collection->conf_name }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticThesisName" class="col-sm-2 col-form-label">論文名稱</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticThesisName"
                value="{{ $collection->thesisName }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticYears" class="col-sm-2 col-form-label">發表年份</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticYears"
                value="{{ $collection->years }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticAuthorNo" class="col-sm-2 col-form-label">作者總人數</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticAuthorNo"
                value="{{ $collection->authorNo }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticCorresponding_author" class="col-sm-2 col-form-label">是否為通訊作者</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticCorresponding_author"
                value="{{ $collection->corresponding_author }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticCountry" class="col-sm-2 col-form-label">舉行之國家/城市</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticCountry"
                value="{{ $collection->country }}">
        </div>
    </div>
</form>
@endsection
