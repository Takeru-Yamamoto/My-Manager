@if (session('alert_message'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error</h5>
        @if (is_array(session('alert_message')))
            {!! nl2br(e(implode("\n", session('alert_message')))) !!}
        @else
            {!! nl2br(e(session('alert_message'))) !!}
        @endif
    </div>
@endif
@if (session('success_message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Success</h5>
        @if (is_array(session('success_message')))
            {!! nl2br(e(implode("\n", session('success_message')))) !!}
        @else
            {!! nl2br(e(session('success_message'))) !!}
        @endif
    </div>
@endif
@if (session('danger_message'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-times"></i> Failure</h5>
        @if (is_array(session('danger_message')))
            {!! nl2br(e(implode("\n", session('danger_message')))) !!}
        @else
            {!! nl2br(e(session('danger_message'))) !!}
        @endif
    </div>
@endif
