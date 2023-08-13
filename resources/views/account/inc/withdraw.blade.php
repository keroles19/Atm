<!-- withdraw Form Total-->
<div class="modal fade" id="withdrawForm" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form
            class="modal-content submit_form_loader_btn"
            id="addCallDatetimeForm"
            method="post"
            action="{{ route('atm.account.withdraw') }}"
        >
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">
                    Make withdrawal From this account from this account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="account_id" value="{{ $account->id }}">
                <div class="row g-2" id="times">
                    <div class="col-md-12 col-lg-11 mb-2">
                        <label class="form-label" for="amount">
                           Amount
                            <span class="text-end"
                                  data-bs-toggle="tooltip"
                                  data-bs-offset="0,4"
                                  data-bs-placement="top"
                                  data-bs-custom-class="tooltip-secondary"
                                  title="The maximum amount for one withdrawal is 100">
                                       <i class="bx bx-info-circle"></i>
                                    </span>
                        </label>
                        <input type="text" name="amount" class="form-control"
                            placeholder="Amount" id="amount"
                            value="{{ old('amount') }}" required
                        >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary" form="addCallDatetimeForm">
                    Withdraw
                </button>
            </div>
        </form>
    </div>
</div>
