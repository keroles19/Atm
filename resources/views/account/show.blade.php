@extends('layouts.app',['title'=> 'User Account - '. $account->holder_name])

@section('content')

    <!--  Balance inquiry for this account. - A total of ten withdrawals per day amount .-->
    <div class="row  g-2 mb-4">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span> Balance </span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">
                                    {{ $account->balance }} $
                                </h4>
                            </div>
                        </div>
                        <span class="badge bg-label-info rounded p-2">
                            <i class="bx bx-dollar-circle bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>
                                total of ten withdrawals per day
                            </span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">
                                    {{ $totalWithdrawalsAmount }}  $
                                </h4>
                            </div>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <i class="bx bx-dollar-circle bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- A List of ten withdrawals per day -->

    <div class="row">
        <div class="col-12">
            <div class="card mb-5 ">
                <div class="card-header">
                    <h5 class="card-text"> A List of ten withdrawals per day </h5>
                    <a href="javascript:(0);" type="button"
                       class="btn btn-outline-primary float-end btn btn-outline-primary  mt-0 mb-0"
                       data-bs-toggle="modal" data-bs-target="#withdrawForm">
                            <span class="d-none d-sm-inline-block">
                                Cash withdrawal
                            </span>
                    </a>

                </div>
                <div class="card-datatable table-responsive pt-0">
                    <table class="datatables-basic table border-top  js-exportable" id="bankTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Operation</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Ref Number</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @forelse($withdrawalsLis as $transaction)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td class="text-center">
                                    {{ $transaction->operation }}
                                </td>
                                <td class="text-center">
                                    {{ $transaction->amount }} $
                                </td>
                                <td class="text-center">
                                <span
                                    @class([
                                        'badge',
                                         'bg-label-success' => $transaction->checkStatus(),
                                         'bg-label-danger' =>  !$transaction->checkStatus()
                                          ])>
                                     {{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ $transaction->reference_number }} $
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <p class="my-4 text-center">
                                        No withdrawals Exist Yet
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('account.inc.withdraw')
@endsection




