<div class="form-group">
    <div class="d-flex align-items-center mb-2">
        <label class="m-0" for="{{ $postCode['name'] }}">{{ $postCode['title'] }}</label>
        <a class="ml-3 {{ btnInfoClass() }} {{ btnSmall() }} search-address-prefecture-postcode-btn"
            data-post-code-input="{{ $postCode['name'] }}" data-address-input="{{ $address['name'] }}"
            data-prefecture-select="{{ isset($prefecture) ? $prefecture['name'] : '' }}">住所検索</a>
    </div>
    <input type="text" name="{{ $postCode['name'] }}" class="form-control" id="{{ $postCode['name'] }}"
        value="{{ $postCode['value'] }}">
</div>
@if (isset($prefecture))
    @include('components.form.select-prefecture', [
        'name' => $prefecture['name'],
        'title' => $prefecture['title'],
        'selected' => $prefecture['value'],
    ])
@endif
<div class="form-group">
    <label for="{{ $address['name'] }}">{{ $address['title'] }}</label>
    <input type="text" name="{{ $address['name'] }}" class="form-control" id="{{ $address['name'] }}"
        value="{{ $address['value'] }}">
</div>
