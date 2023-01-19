<div class="form-group">
    <label for="{{ $postCode['name'] }}">{{ $postCode['title'] }}</label>
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
