<div class="form-group">
    <label for="input-file-{{ $type }}">{{ $title }}</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="import_file" id="input-file-{{ $type }}">
            <label class="custom-file-label" data-browse="参照" for="input-file-{{ $type }}">ファイルを選択してください。</label>
        </div>
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-secondary input-group-text input-file-destroy"
                data-type="{{ $type }}">取消</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    bsCustomFileInput.init("input#input-file-{{ $type }}");
</script>
