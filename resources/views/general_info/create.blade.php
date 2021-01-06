@extends('layouts.main')

@section('title')
<span>
    <h4>基本資料</h4>
</span>
@endsection

@section('card-body-content')
<span>(*為選填)</span>
<form action="" method="POST">

    <div class="form-group">
        <label for="englishName">英文姓名</label>
        <input type="text" class="form-control" id="englishName" name="englishName">
        @error('englishName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="birthday">生日</label>
        <input type="text" class="form-control" id="birthday" name="birthday" aria-describedby="birthdayHelp">
        <small id="birthdayHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('birthday')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <label for="sex">性別</label><br />
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="sex" id="sex1" value="0">
        <label class="form-check-label" for="sex1">
            女
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="sex" id="sex2" value="1">
        <label class="form-check-label" for="sex2">
            男
        </label>
    </div>

    @error('sex')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    <div class="form-group">
        <label for="telephone">聯絡電話</label>
        <input type="text" class="form-control" id="telephone" name="telephone" aria-describedby="telephoneHelp">
        <small id="telephoneHelp" class="form-text text-muted">不須間隔，例如0987654321</small>
        @error('telephone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input type="email" class="form-control" id="email" name="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="Permanent_Address">戶籍地址</label>
        <input type="text" class="form-control" id="Permanent_Address" name="Permanent_Address">
        @error('Permanent_Address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="Residential_Address">通訊地址</label>
        <input type="text" class="form-control" id="Residential_Address" name="Residential_Address">
        @error('Residential_Address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="teacherCertificateType">教師證職級</label>
        <select class="form-control" id="teacherCertificateType" name="teacherCertificateType">
            <option value="教授">教授</option>
            <option value="副教授">副教授</option>
            <option value="助理教授">助理教授</option>
            <option value="副教授">講師</option>
            <option value="無">無</option>
        </select>
    </div>

    <div class="form-group">
        <label for="teacherCertificateFiles">教師證影本上傳 (無則免附)</label>
        <input type="file" class="form-control-file" id="teacherCertificateFiles" name="teacherCertificateFiles">
        @error('teacherCertificateFiles')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="position">現職</label>
        <input type="text" class="form-control" id="position" name="position">
        @error('position')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="specialization">專長領域</label>
        <select class="form-control" id="specialization" name="specialization">
            <option value="智慧流通">智慧流通</option>
            <option value="物流運輸">物流運輸</option>
            <option value="新零售">新零售</option>
            <option value="其他">其他</option>
        </select>
    </div>

    <div class="form-group">
        <label for="course">曾授課程/可授課程</label>
        <textarea class="form-control" id="course" name="course" rows="3" aria-describedby="courseHelp"></textarea>
        <small id="courseHelp" class="form-text text-muted">請使用全形頓點間格(、)</small>
        @error('course')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">新增</button>
</form>
@endsection
