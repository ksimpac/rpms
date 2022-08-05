@csrf
<div class="form-group">
    <label for="working_units">任職單位</label>
    <input type="text" class="form-control @error('working_units') is-invalid @enderror" id="working_units"
        name="working_units" value="{{ old('working_units') ?? $industry_experience->working_units ?? '' }}">
    @error('working_units')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="position">職稱</label>
    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position"
        value="{{ old('position') ?? $industry_experience->working_units ?? '' }}">
    @error('position')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="@error('type') is-invalid @enderror">
    <label for="type">兼專任</label><br />
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="type" id="type1" value="part-time"
            {{ isset($industry_experience->type) && $industry_experience->type == '兼任' ? 'checked' : (old('type') == 'part-time' ? 'checked' : '') }}>
        <label class="form-check-label" for="type1">
            兼任
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="type" id="type2" value="full-time"
            {{ isset($industry_experience->type) && $industry_experience->type == '專任' ? 'checked' : (old('type') == 'full-time' ? 'checked' : '') }}>
        <label class="form-check-label" for="type2">
            專任
        </label>
    </div>
</div>


@error('type')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror


<div class="form-group">
    <label for="job_description">工作內容</label>
    <textarea class="form-control @error('job_description') is-invalid @enderror" id="job_description"
        name="job_description" rows="3">{{ old('job_description') ?? $industry_experience->job_description ?? '' }}</textarea>
    @error('job_description')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="startDate">任職時間起</label>
    <input type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate"
        aria-describedby="startDateHelp" value="{{ old('startDate') ?? $industry_experience->startDate ?? '' }}">
    @error('startDate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="endDate">任職時間迄</label>
    <input type="text" class="form-control @error('endDate') is-invalid @enderror" id="endDate" name="endDate"
        aria-describedby="endDateHelp" value="{{ old('endDate') ?? $industry_experience->endDate ?? '' }}">
    @error('endDate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="identification">佐證資料上傳 (如：勞工保險證明或服務證明)(PDF檔案)</label>
    <input type="file" class="form-control-file @error('identification') is-invalid @enderror" id="identification"
        name="identification">
    @error('identification')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<script>
    var param = {
        enableTime: false,
        locale: "zh_tw",
        plugins: [
            new monthSelectPlugin({
                shorthand: true,
                dateFormat: "Y/m",
                altFormat: "Y/m",
                theme: "light"
            })
        ]
    };

    var startDate = document.getElementById('startDate');
    var endDate = document.getElementById('endDate');

    //Initialize
    startDate.flatpickr(param);
    endDate.flatpickr(param);

    //Reinitialize endDate after startDate change
    startDate.addEventListener('change', function() {
        param.minDate = startDate.value;
        endDate.flatpickr(param);
    });
</script>
