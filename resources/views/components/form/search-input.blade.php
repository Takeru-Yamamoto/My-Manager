<input type="{{ isset($toType) ? $toType : 'number' }}" name="{{ $model }}_{{ $to }}"
    id="{{ $model }}_{{ $to }}" value="{{ isset($toValue) ? $toValue : old($model . '_' . $to) }}"
    hidden />
<div class="form-group">
    <label for="{{ $model }}_{{ $from }}">{{ $title }}</label>
    <input type="{{ isset($fromType) ? $fromType : 'text' }}" class="form-control search-input"
        value="{{ isset($fromValue) ? $fromValue : old($model . '_' . $from) }}"
        name="{{ $model }}_{{ $from }}" id="{{ $model }}_{{ $from }}"
        data-model="{{ $model }}" data-from="{{ $from }}" data-to="{{ $to }}"
        data-eloquent="{{ isset($eloquent) ? $eloquent : 'where' }}" data-limit="{{ isset($limit) ? $limit : 10 }}"
        data-additional="{{ isset($additional) && is_array($additional) ? json_encode($additional) : '' }}"
        data-url="{{ route('search') }}" data-duplicate-count="{{ isset($duplicateCount) ? $duplicateCount : '' }}" />
</div>
<div id="search-result{{ isset($duplicateCount) ? $duplicateCount : '' }}" class="mb-3"></div>
