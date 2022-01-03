@csrf
<div class="form-group">
    <label for="publicationName">刊物名稱</label>
    <input type="text" class="form-control @error('publicationName') is-invalid @enderror" id="publicationName"
        name="publicationName" value="{{ old('publicationName') ?? $collection->publicationName ?? '' }}">
    @error('publicationName')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="publicationDate">年月</label>
    <input type="text" class="form-control @error('publicationDate') is-invalid @enderror" id="publicationDate"
        name="publicationDate" aria-describedby="publicationDateHelp"
        value="{{ old('publicationDate') ?? $collection->publicationDate ?? '' }}">
    <small id="publicationDateHelp" class="form-text text-muted">格式為西元年/月，例如1901/01</small>
    @error('publicationDate')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="DOI">DOI</label>
    <input type="text" class="form-control @error('DOI') is-invalid @enderror" id="DOI" name="DOI"
        value="{{ old('DOI') ?? $collection->DOI ?? '' }}">
    @error('DOI')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="authorNo">作者總人數</label>
    <input type="number" class="form-control @error('authorNo') is-invalid @enderror" id="authorNo" name="authorNo"
        value="{{ old('authorNo') ?? $collection->authorNo ?? '' }}" min="1">
    @error('authorNo')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="order">作者順序</label>
    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
        value="{{ old('order') ?? $collection->order ?? '' }}" min="1">
    @error('order')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="rank_factor">Journal Rank: N/M</label>
    <input type="text" class="form-control @error('rank_factor') is-invalid @enderror" id="rank_factor"
        name="rank_factor" value="{{ old('rank_factor') ?? $collection->rank_factor ?? '' }}">
    @error('rank_factor')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="alert alert-warning" role="alert">
    <h4 class="alert-heading">Journal Rank: N/M</h4>
    <p>SCI/SSCI Rank：N為期刊在所屬研究領域之排序名次；M為該期刊所屬研究領域之總期刊數。（Impact Factor以最近年度ISI資料庫之資料為準）</p>
</div>

<div class="@error('corresponding_author') is-invalid @enderror">
    <label for="corresponding_author">是否為通訊作者</label><br />
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="corresponding_author" id="corresponding_author1" value="0" {{
            isset($collection->corresponding_author) && $collection->corresponding_author == '0' ? 'checked' :
        (old('corresponding_author') == '0' ? 'checked': '') }}>
        <label class="form-check-label" for="corresponding_author1">
            否
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="corresponding_author" id="corresponding_author2" value="1" {{
            isset($collection->corresponding_author) && $collection->corresponding_author == '1' ? 'checked' :
        (old('corresponding_author') == '1' ? 'checked': '') }}>
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
    <label for="thesisName">論文名稱</label>
    <input type="text" class="form-control @error('thesisName') is-invalid @enderror" id="thesisName" name="thesisName"
        value="{{ old('thesisName') ?? $collection->thesisName ?? ''  }}">
    @error('thesisName')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="type">收錄分類</label>
    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type">
        <option value="SCI" {{ isset($collection->type) && $collection->type == 'SCI' ? 'selected' : (old('type') ==
            "SCI" ? 'selected' : '') }}>
            SCI</option>
        <option value="SCIE" {{ isset($collection->type) && $collection->type == 'SCIE' ? 'selected' : (old('type') ==
            "SCIE" ? 'selected' : '') }}>
            SCIE</option>
        <option value="SSCI" {{ isset($collection->type) && $collection->type == 'SSCI' ? 'selected' : (old('type') ==
            "SSCI" ? 'selected' : '') }}>
            SSCI</option>
        <option value="Other" {{ isset($collection->type) && $collection->type == '其他' ? 'selected' : (old('type') ==
            "Other" ? 'selected' : '') }}>
            其他</option>
        @error('type')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </select>
</div>
<div class="form-group">
    <label for="identification">佐證資料上傳(公開發表論文電子全文)(PDF檔案)</label>
    <input type="file" class="form-control-file @error('identification') is-invalid @enderror" id="identification"
        name="identification">
    @error('identification')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
