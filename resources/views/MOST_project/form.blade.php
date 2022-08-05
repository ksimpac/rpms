@csrf
<div class="form-group">
    <label for="projectName">計畫名稱</label>
    <input type="text" class="form-control @error('projectName') is-invalid @enderror" id="projectName"
        name="projectName" value="{{ old('projectName') ?? $most_project->projectName ?? '' }}">
    @error('projectName')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="startDate">執行起始日期</label>
    <input type="text" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate"
        aria-describedby="startDateHelp" value="{{ old('startDate') ?? $most_project->startDate ?? '' }}">
    @error('startDate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="endDate">執行結束日期</label>
    <input type="text" class="form-control @error('endDate') is-invalid @enderror" id="endDate" name="endDate"
        aria-describedby="endDateHelp" value="{{ old('endDate') ?? $most_project->endDate ?? '' }}">
    @error('endDate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="@error('jobkind') is-invalid @enderror">
    <label for="jobkind">工作類別</label><br />
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jobkind" id="jobkind1" value="0"
            {{ isset($most_project->jobkind) && $most_project->jobkind == '主持人' ? 'checked' : (old('jobkind') == '0' ? 'checked' : '') }}>
        <label class="form-check-label" for="jobkind1">
            主持人
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="jobkind" id="jobkind2" value="1"
            {{ isset($most_project->jobkind) && $most_project->jobkind == '共同主持人' ? 'checked' : (old('jobkind') == '1' ? 'checked' : '') }}>
        <label class="form-check-label" for="jobkind2">
            共同主持人
        </label>
    </div>
</div>

@error('jobkind')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror


<div class="form-group">
    <label for="plantotal_money">計畫總金額</label>
    <input type="number" class="form-control @error('plantotal_money') is-invalid @enderror" id="plantotal_money"
        name="plantotal_money" value="{{ old('plantotal_money') ?? $most_project->plantotal_money ?? '' }}">
    @error('plantotal_money')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="identification">佐證資料上傳(PDF檔案)</label>
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
        dateFormat: "Y/m/d",
        altFormat: "Y/m/d",
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
