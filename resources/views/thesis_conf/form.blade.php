@csrf
<div class="form-group">
    <label for="conf_name">研討會名稱</label>
    <input type="text" class="form-control @error('conf_name') is-invalid @enderror" id="conf_name" name="conf_name"
        value="{{ old('conf_name') ?? $thesis_conf->conf_name ?? '' }}">
    @error('conf_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="thesisName">論文名稱</label>
    <input type="text" class="form-control @error('thesisName') is-invalid @enderror" id="thesisName" name="thesisName"
        value="{{ old('thesisName') ?? $thesis_conf->thesisName ?? '' }}">
    @error('thesisName')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="years">發表年份</label>
    <input type="number" class="form-control @error('years') is-invalid @enderror" id="years" name="years"
        value="{{ old('years') ?? $thesis_conf->years ?? '' }}">
    <small id="yearsHelp" class="form-text text-muted">選單月份請隨意選擇，不影響結果</small>
    @error('years')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="authorNo">作者總人數</label>
    <input type="number" class="form-control @error('authorNo') is-invalid @enderror" id="authorNo" name="authorNo"
        value="{{ old('authorNo') ?? $thesis_conf->authorNo ?? '' }}">
    @error('authorNo')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="@error('corresponding_author') is-invalid @enderror">
    <label for="corresponding_author">是否為通訊作者</label><br />
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="corresponding_author" id="corresponding_author1" value="0"
            {{ isset($thesis_conf->corresponding_author) && $thesis_conf->corresponding_author == '0' ? 'checked' : (old('corresponding_author') == '0' ? 'checked' : '') }}>
        <label class="form-check-label" for="corresponding_author1">
            否
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="corresponding_author" id="corresponding_author2" value="1"
            {{ isset($thesis_conf->corresponding_author) && $thesis_conf->corresponding_author == '1' ? 'checked' : (old('corresponding_author') == '1' ? 'checked' : '') }}>
        <label class="form-check-label" for="corresponding_author2">
            是
        </label>
    </div>
</div>

@error('corresponding_author')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror

<div class="form-group">
    <label for="country">舉行之國家/城市</label>
    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country"
        value="{{ old('country') ?? $thesis_conf->country ?? '' }}">
    @error('country')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<script>
    document.getElementById('years').flatpickr({
        enableTime: false,
        locale: "zh_tw",
        plugins: [
            new monthSelectPlugin({
                shorthand: true,
                dateFormat: "Y",
                altFormat: "Y",
                theme: "light"
            })
        ]
    });
</script>
