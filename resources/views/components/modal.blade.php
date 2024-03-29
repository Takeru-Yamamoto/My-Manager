<div class="modal fade" id="{{ isset($id) ? $id : 'modal' }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @yield('modal_title')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @yield('modal_body')
            </div>
            <div class="modal-footer">
                @yield('modal_footer')
            </div>
        </div>
    </div>
</div>
