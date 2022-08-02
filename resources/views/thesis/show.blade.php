@extends('layouts.main')

@section('title')
@include('thesis.title')
@endsection

@section('card-body-content')
<form action="#">
    <div class="form-group row">
        <label for="staticPublicationName" class="col-sm-2 col-form-label">刊物名稱</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticPublicationName"
                value="{{ $thesis->publicationName }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticPublicationDate" class="col-sm-2 col-form-label">年月</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticPublicationDate"
                value="{{ $thesis->publicationDate }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticDOI" class="col-sm-2 col-form-label">DOI</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticDOI" value="{{ $thesis->DOI }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticAuthorNo" class="col-sm-2 col-form-label">作者總人數</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticAuthorNo"
                value="{{ $thesis->authorNo }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticOrder" class="col-sm-2 col-form-label">作者順序</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticOrder"
                value="{{ $thesis->order }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticRank_factor" class="col-sm-2 col-form-label">作者順序</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticRank_factor"
                value="{{ $thesis->rank_factor }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticCorresponding_author" class="col-sm-2 col-form-label">是否為通訊作者</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticCorresponding_author"
                value="{{ $thesis->corresponding_author }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticThesisName" class="col-sm-2 col-form-label">論文名稱</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticThesisName"
                value="{{ $thesis->thesisName }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticType" class="col-sm-2 col-form-label">收錄分類</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticType" value="{{ $thesis->type }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticIdentification" class="col-sm-2 col-form-label">佐證資料上傳</label>
        <div class="col-sm-10">
            <a href="{{ url(Storage::url('thesis/' . $thesis->identification)) }}" target="_blank"
                class="form-control-plaintext">{{ $thesis->identification }}</a>
        </div>
    </div>

</form>
@endsection
