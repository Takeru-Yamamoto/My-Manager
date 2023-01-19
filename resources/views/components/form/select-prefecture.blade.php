<div class="form-group">
    <label for="{{ $name }}">{{ $title }}</label>
    <select class="form-control" name="{{ $name }}" id="{{ $name }}">
        <option>選択してください。</option>
        @foreach (PrefectureConst::PREFECTURES_FULL_KANJI as $prefecture => $prefectureFullKanji)
            <option value="{{ $prefecture }}" {{ isset($selected) && $selected === $prefecture ? 'selected' : '' }}>
                {{ $prefectureFullKanji }}</option>
        @endforeach
    </select>
</div>
