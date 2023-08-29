@if ($this->enableModal)
    <div class="modal fade show" tabindex="-1" role="dialog" id="fire-modal-7" style="display: block" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Realy?</h5>
                    <button type="button" wire:click="disableModal" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"> Do you want to remove record?</div>
                <div class="modal-footer">
                    <button type="button"
                            wire:click="delete({{ $this->deleteId }})"
                            class="btn btn-danger btn-shadow bg-danger" id="">Yes</button>
                    <button type="button"
                            wire:click="disableModal"
                            class="btn btn-secondary bg-primary" id="">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endif
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $(document).on('click', '[data-delete]', function (e) {
                e.preventDefault();
                $('#fire-modal-7').on('shown.bs.modal')
            });
        });
    </script>
@endsection
