@extends('layouts.main')

@section('title')
@include('general_info.title')
@endsection

@section('card-body-content')
<form action="#">
    <div class="form-group row">
        <label for="staticEnglishLastName" class="col-sm-2 col-form-label">英文姓氏</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEnglishLastName"
                value="{{ $general_info->englishLastName}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticEnglishFirstName" class="col-sm-2 col-form-label">英文名字</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEnglishFirstName"
                value="{{ $general_info->englishFirstName }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticBirthday" class="col-sm-2 col-form-label">生日</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticBirthday"
                value="{{ $general_info->birthday }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticSex" class="col-sm-2 col-form-label">性別</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticSex" value="{{ $general_info->gender }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticTelephone" class="col-sm-2 col-form-label">聯絡電話</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticTelephone"
                value="{{ $general_info->telephone }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticPermanent_Address" class="col-sm-2 col-form-label">戶籍地址</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticPermanent_Address"
                value="{{ $general_info->Permanent_Address }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticResidential_Address" class="col-sm-2 col-form-label">通訊地址</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticResidential_Address"
                value="{{ $general_info->Residential_Address }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticTeacherCertificateType" class="col-sm-2 col-form-label">教師證級別</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticTeacherCertificateType"
                value="{{ $general_info->teacherCertificateType }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticTeacherCertificateFiles" class="col-sm-2 col-form-label">教師證影本</label>
        <div class="col-sm-10">
            @if(isset($general_info->teacherCertificateFiles))
            <span><a href="{{ url(Storage::url('general_info/' . $general_info->teacherCertificateFiles)) }}"
                    target="_blank" class="form-control-plaintext">{{ $general_info->teacherCertificateFiles }}</a></span>
            <span></span>
            @else
            無
            @endif
        </div>
    </div>

    <label>現職</label>

    <div class="ml-5 form-group row">
        <label for="staticWorking_units" class="col-sm-2 col-form-label">公司機構名稱</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticWorking_units"
                value="{{ $general_info->working_units }}">
        </div>
    </div>

    <div class="ml-5 form-group row">
        <label for="staticPosition" class="col-sm-2 col-form-label">職位</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticPosition"
                value="{{ $general_info->position }}">
        </div>
    </div>

    <div class="ml-5 form-group row">
        <label for="staticStartDate" class="col-sm-2 col-form-label">到職年月</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticStartDate"
                value="{{ $general_info->startDate }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticSpecialization" class="col-sm-2 col-form-label">專長領域</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticSpecialization"
                value="{{ $general_info->specialization }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticCourse" class="col-sm-2 col-form-label">曾授課程/可授課程</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticCourse"
                value="{{ $general_info->course }}">
        </div>
    </div>
</form>
@endsection
