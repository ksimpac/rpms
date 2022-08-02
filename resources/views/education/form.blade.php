@csrf
<div class="form-group">
    <label for="schoolName">學校名</label>
    <input type="text" class="form-control @error('schoolName') is-invalid @enderror" id="schoolName" name="schoolName"
        value="{{ old('schoolName') ?? $education->schoolName ?? '' }}">
    @error('schoolName')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="department">院系科名</label>
    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department"
        value="{{ old('department') ?? $education->department ?? '' }}">
    @error('department')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="startDate">修業年月起</label>
    <input type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate"
        aria-describedby="startDateHelp" value="{{ old('startDate') ?? $education->startDate ?? '' }}">
    <small id="startDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
    @error('startDate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="endDate">修業年月迄</label>
    <input type="text" class="form-control @error('endDate') is-invalid @enderror" id="endDate" name="endDate"
        aria-describedby="endDateHelp" value="{{ old('endDate') ?? $education->endDate ?? '' }}">
    <small id="endDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
    @error('endDate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="degree">學位</label>
    <select id="degree" class="form-control @error('degree') is-invalid @enderror" name="degree"
        @if(Request::route()->getName() == 'education.edit') disabled @endif>
        <option value="Bachelor"
            {{ isset($education->degree) && $education->degree === 'Bachelor' ? 'selected' : (old('degree') == 'Bachelor' ? 'selected' : '') }}>
            大學</option>
        <option value="Master"
            {{ isset($education->degree) && $education->degree === 'Master' ? 'selected' : (old('degree') == 'Master' ? 'selected' : '') }}>
            碩士</option>
        <option value="PhD"
            {{ isset($education->degree) && $education->degree === 'PhD' ? 'selected' : (old('degree') == 'PhD' ? 'selected' : '') }}>
            博士</option>
    </select>
    @error('degree')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="status">修業狀況</label>
    <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
        <option value="Graduation"
            {{ isset($education->status) && $education->status === '畢業' ? 'selected' : (old('status') == 'Graduation' ? 'selected' : '') }}>
            畢業</option>
        <option value="Completion"
            {{ isset($education->status) && $education->status === '結業' ? 'selected' : (old('status') == 'Completion' ? 'selected' : '') }}>
            結業</option>
        <option value="Attendance"
            {{ isset($education->status) && $education->status === '肆業' ? 'selected' : (old('status') == 'Attendance' ? 'selected' : '') }}>
            肆業</option>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </select>
</div>

<div class="form-group">
    <label for="country">畢業國家</label>
    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country"
        value="{{ old('country') ?? $education->country ?? '' }}">
    @error('country')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="thesis">畢業論文 (大學免填)</label>
    <input type="text" class="form-control @error('thesis') is-invalid @enderror" id="thesis" name="thesis"
        value="{{ old('thesis') ?? $education->thesis ?? '' }}">
    @error('thesis')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="advisor">指導教授 (大學免填)</label>
    <input type="text" class="form-control @error('advisor') is-invalid @enderror" id="advisor" name="advisor"
        value="{{ old('advisor') ?? $education->advisor ?? '' }}">
    @error('advisor')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="certificate">畢業證書上傳(PDF檔案)</label>
    <input type="file" class="form-control-file @error('certificate') is-invalid @enderror" id="certificate"
        name="certificate">
    @error('certificate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="transcript">成績單上傳(PDF檔案)</label>
    <input type="file" class="form-control-file @error('transcript') is-invalid @enderror" id="transcript"
        name="transcript">
    @error('transcript')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
