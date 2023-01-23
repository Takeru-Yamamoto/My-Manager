@if (sessionHas('alert_message'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa-solid fa-ban"></i> Error</h5>
        @if (is_array(sessionGet('alert_message')))
            {!! enl2br(implode("\n", sessionGet('alert_message'))) !!}
        @else
            {!! enl2br(sessionGet('alert_message')) !!}
        @endif
    </div>
@endif
@if (sessionHas('success_message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa-solid fa-check"></i> Success</h5>
        @if (is_array(sessionGet('success_message')))
            {!! enl2br(implode("\n", sessionGet('success_message'))) !!}
        @else
            {!! enl2br(sessionGet('success_message')) !!}
        @endif
    </div>
@endif
@if (sessionHas('danger_message'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa-solid fa-xmark"></i> Failure</h5>
        @if (is_array(sessionGet('danger_message')))
            {!! enl2br(implode("\n", sessionGet('danger_message'))) !!}
        @else
            {!! enl2br(sessionGet('danger_message')) !!}
        @endif
    </div>
@endif
