<div class="accordion" id="accordion">
    <div class="card m-0">
        <div class="card-header accordion-header d-flex justify-content-between align-items-center pointer"
            id="header-{{ $type }}" data-toggle="collapse" data-target="#card-{{ $type }}"
            aria-expanded="false" aria-controls="card-{{ $type }}">
            <p class="m-0">{{ $title }}</p>
            <i class="fa-solid fa-chevron-down accordion-open accordion-nav active"></i>
            <i class="fa-solid fa-chevron-up accordion-close accordion-nav"></i>
        </div>
        <div id="card-{{ $type }}" class="collapse" aria-labelledby="header-{{ $type }}"
            data-parent="#accordion">
            <div class="card-body">
                @yield('accordion-body')
            </div>
        </div>
    </div>
</div>
