<!-- withdraw Form Total-->
<div class="modal fade" id="accountForm" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form
            class="modal-content submit_form_loader_btn"
            id="addCallDatetimeForm"
            method="post"
            action="{{ route('atm.account.store') }}"
        >
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">
                    Create a new Account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row " id="times">
                    <div class="col-md-12 col-lg-11 mb-2">
                        <label class="form-label" for="account_number">
                            Account Number
                            <span class="text-end"
                                  data-bs-toggle="tooltip"
                                  data-bs-offset="0,4"
                                  data-bs-placement="top"
                                  data-bs-custom-class="tooltip-secondary"
                                  title="must be 16 numbers">
                                       <i class="bx bx-info-circle"></i>
                                    </span>
                        </label>
                        <input type="text" name="account_number" class="form-control"
                            placeholder="Account Number" id="Account Number"
                            value="{{ old('account_number') }}" required
                        >
                    </div>

                    <div class="col-md-12 col-lg-11 mb-2">
                        <label class="form-label" for="holder_name">
                            Holder Name
                        </label>
                        <input type="text" name="holder_name" class="form-control"
                               placeholder="Holder Name" id="Holder Name"
                               value="{{ old('holder_name') }}" required
                        >
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary" form="addCallDatetimeForm">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
