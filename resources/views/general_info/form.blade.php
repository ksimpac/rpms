@csrf
<div class="form-group">
    <label for="englishLastName">英文姓氏</label>
    <input type="text" class="form-control @error('englishLastName') is-invalid @enderror" id="englishLastName"
        name="englishLastName" value="{{ old('englishLastName') ?? $collection->englishLastName ?? '' }}">
    @error('englishLastName')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="englishFirstName">英文名字</label>
    <input type="text" class="form-control @error('englishFirstName') is-invalid @enderror" id="englishFirstName"
        name="englishFirstName" value="{{ old('englishFirstName') ?? $collection->englishFirstName ?? '' }}">
    @error('englishFirstName')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="birthday">生日</label>
    <input type="text" class="form-control @error('birthday') is-invalid @enderror" id="birthday" name="birthday"
        aria-describedby="birthdayHelp" value="{{ old('birthday') ?? $collection->birthday ?? '' }}">
    <small id="birthdayHelp" class="form-text text-muted">格式為西元年/月/日，例如1901/01/01</small>
    @error('birthday')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="@error('sex') is-invalid @enderror">
    <label for="sex">性別</label><br />
    <div class="form-check form-check-inline">
        <input class="form-check-input " type="radio" name="sex" id="sex1" value="0"
            {{ isset($collection->sex) && $collection->sex == '0' ? 'checked' : (old('sex') == '0' ? 'checked': '') }}>
        <label class="form-check-label" for="sex1">
            女
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="sex" id="sex2" value="1"
            {{ isset($collection->sex) && $collection->sex == '1' ? 'checked' : (old('sex') == '1' ? 'checked': '') }}>
        <label class="form-check-label" for="sex2">
            男
        </label>
    </div>
</div>

@error('sex')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror

<div class="form-group">
    <label for="telephone">聯絡電話</label>
    <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone"
        aria-describedby="telephoneHelp" value="{{ old('telephone') ?? $collection->telephone ?? '' }}">
    <small id="telephoneHelp" class="form-text text-muted">不須間隔，例如0987654321</small>
    @error('telephone')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="Permanent_Address">戶籍地址</label>
    <input type="text" class="form-control @error('Permanent_Address') is-invalid @enderror" id="Permanent_Address"
        name="Permanent_Address" value="{{ old('Permanent_Address') ?? $collection->Permanent_Address ?? '' }}">
    @error('Permanent_Address')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="Residential_Address">通訊地址</label>
    <input type="text" class="form-control @error('Residential_Address') is-invalid @enderror" id="Residential_Address"
        name="Residential_Address" value="{{ old('Residential_Address') ?? $collection->Residential_Address ?? '' }}">
    @error('Residential_Address')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="teacherCertificateType">教師證職級</label>
    <select class="form-control" id="teacherCertificateType" name="teacherCertificateType">
        <option value="Professor"
            {{ isset($collection->teacherCertificateType) && $collection->teacherCertificateType == '教授' ? 'selected' : (old('teacherCertificateType') == 'Professor' ? 'selected' : '') }}>
            教授</option>
        <option value="Associate Professor"
            {{ isset($collection->teacherCertificateType) && $collection->teacherCertificateType == '副教授' ? 'selected' : (old('teacherCertificateType') == 'Associate Professor' ? 'selected' : '') }}>
            副教授</option>
        <option value="Assistant Professor"
            {{ isset($collection->teacherCertificateType) && $collection->teacherCertificateType == '助理教授' ? 'selected' : (old('teacherCertificateType') == 'Assistant Professor' ? 'selected' : '') }}>
            助理教授</option>
        <option value="Lecturer"
            {{ isset($collection->teacherCertificateType) && $collection->teacherCertificateType == '講師' ? 'selected' : (old('teacherCertificateType') == 'Lecturer' ? 'selected' : '') }}>
            講師</option>
        <option value="None"
            {{ isset($collection->teacherCertificateType) && $collection->teacherCertificateType == '無' ? 'selected' : (old('teacherCertificateType') == 'None' ? 'selected' : '') }}>
            無</option>
    </select>
</div>

<div class="form-group">
    <label for="teacherCertificateFiles">教師證影本上傳 (無則免附)(PDF檔案)</label>
    <input type="file" class="form-control-file @error('teacherCertificateFiles') is-invalid @enderror"
        id="teacherCertificateFiles" name="teacherCertificateFiles">
    @error('teacherCertificateFiles')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div>
    <label>現職</label>

    <div class="ml-4 form-group">
        <label for="working_units">公司機構名稱</label>
        <input type="text" class="form-control @error('working_units') is-invalid @enderror" id="working_units"
            name="working_units" value="{{ old('working_units') ?? $collection->working_units ?? '' }}">
        @error('working_units')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="ml-4 form-group">
        <label for="position">職稱</label>
        <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position"
            value="{{ old('position') ?? $collection->position ?? '' }}">
        @error('position')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="ml-4 form-group">
        <label for="startDate">到職年月</label>
        <input type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate"
            aria-describedby="startDateHelp" value="{{ old('startDate') ?? $collection->startDate ?? '' }}">
        <small id="startDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
        @error('startDate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="specialization">專長領域</label>
    <select class="form-control" id="specialization" name="specialization">
        <option value="0"
            {{ isset($collection->specialization) && $collection->specialization == '智慧流通' ? 'selected' : (old('specialization') == '0' ? 'selected' : '') }}>
            智慧流通</option>
        <option value="1"
            {{ isset($collection->specialization) && $collection->specialization == '物流運輸' ? 'selected' : (old('specialization') == '1' ? 'selected' : '') }}>
            物流運輸</option>
        <option value="2"
            {{ isset($collection->specialization) && $collection->specialization == '新零售' ? 'selected' : (old('specialization') == '2' ? 'selected' : '') }}>
            新零售</option>
        <option value="3"
            {{ isset($collection->specialization) && $collection->specialization == '其他' ? 'selected' : (old('specialization') == '3' ? 'selected' : '') }}>
            其他</option>
    </select>
</div>

<div class="form-group">
    <label for="course">曾授課程/可授課程</label>
    <textarea class="form-control @error('course') is-invalid @enderror" id="course" name="course" rows="3"
        aria-describedby="courseHelp">{{ old('course') ?? $collection->course ?? ''  }}</textarea>
    <small id="courseHelp" class="form-text text-muted">請使用全形頓點間隔(、)</small>
    @error('course')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
