@csrf
<div class="form-group">
    <label for="schoolName">學校名</label>
    <input type="text" class="form-control @error('schoolName') is-invalid @enderror" id="schoolName" name="schoolName"
        value="{{ old('schoolName') ?? $collection->schoolName ?? '' }}">
    @error('schoolName')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="department">院系科名</label>
    <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department"
        value="{{ old('department') ?? $collection->department ?? '' }}">
    @error('department')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="startDate">修業年月起</label>
    <input type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate"
        aria-describedby="startDateHelp" value="{{ old('startDate') ?? $collection->startDate ?? '' }}">
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
        aria-describedby="endDateHelp" value="{{ old('endDate') ?? $collection->endDate ?? '' }}">
    <small id="endDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
    @error('endDate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="degree">學位</label>
    <select id="degree" class="form-control @error('degree') is-invalid @enderror" name="degree">
        <option value="大學"
            {{ isset($collection->degree) && $collection->degree === '大學' ? 'selected' : (old('degree') == '大學' ? 'selected' : '') }}>
            大學</option>
        <option value="碩士"
            {{ isset($collection->degree) && $collection->degree === '碩士' ? 'selected' : (old('degree') == '碩士' ? 'selected' : '') }}>
            碩士</option>
        <option value="博士"
            {{ isset($collection->degree) && $collection->degree === '博士' ? 'selected' : (old('degree') == '博士' ? 'selected' : '') }}>
            博士</option>
        @error('degree')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </select>
</div>

<div class="form-group">
    <label for="status">修業狀況</label>
    <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
        <option value="畢業"
            {{ isset($collection->status) && $collection->status === '畢業' ? 'selected' : (old('status') == '畢業' ? 'selected' : '') }}>
            畢業</option>
        <option value="結業"
            {{ isset($collection->status) && $collection->status === '結業' ? 'selected' : (old('status') == '結業' ? 'selected' : '') }}>
            結業</option>
        <option value="肆業"
            {{ isset($collection->status) && $collection->status === '肆業' ? 'selected' : (old('status') == '肆業' ? 'selected' : '') }}>
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
        value="{{ old('country') ?? $collection->country ?? '' }}">
    @error('country')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="thesis">畢業論文 (大學免填)</label>
    <input type="text" class="form-control @error('thesis') is-invalid @enderror" id="thesis" name="thesis"
        value="{{ old('thesis') ?? $collection->thesis ?? '' }}">
    @error('thesis')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="advisor">指導教授 (大學免填)</label>
    <input type="text" class="form-control @error('advisor') is-invalid @enderror" id="advisor" name="advisor"
        value="{{ old('advisor') ?? $collection->advisor ?? '' }}">
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
