<div class="form-group {{ isset($addClass) ? $addClass : '' }}">
    <label for="{{ $name }}">{{ $title }}</label>
    <select class="form-control" name="{{ $name }}" id="{{ $name }}">
        <option value="">選択してください。</option>
        @foreach (config('prefecture.kanji_full') as $prefecture => $prefectureFullKanji)
            <option value="{{ $prefecture }}" {{ isset($selected) && $selected === $prefecture ? 'selected' : '' }}>
                {{ $prefectureFullKanji }}</option>
        @endforeach
    </select>
</div>
