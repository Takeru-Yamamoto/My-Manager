<div class="form-group">
    <label for="input-file-{{ $type }}">{{ $title }}</label>
    <div class="input-group">
        <div class="custom-file">
            @if (isset($multiple))
                <input type="file" class="custom-file-input" name="{{ $name }}[]"
                    id="input-file-{{ $type }}" multiple>
            @else
                <input type="file" class="custom-file-input" name="{{ $name }}"
                    id="input-file-{{ $type }}">
            @endif
            <label class="custom-file-label" data-browse="参照"
                for="input-file-{{ $type }}">ファイルを選択してください。</label>
        </div>
        <div class="input-group-append">
            <button type="button" id="input-file-destroy-{{ $type }}"
                class="btn btn-outline-secondary input-group-text">取消</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    bsCustomFileInput.init("input#input-file-{{ $type }}");
    document.getElementById('input-file-destroy-{{ $type }}').addEventListener('click', function() {
        var elem = document.getElementById('input-file-{{ $type }}');
        elem.value = '';
        elem.dispatchEvent(new Event('change'));
    });
</script>
