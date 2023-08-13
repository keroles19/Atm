@extends('layouts.app',['title'=> 'Home'])

@section('content')

    <div class="card mb-5 ">
        <div class="card-header">
            <p>the last five transactions over all accounts. </p>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table border-top  js-exportable" id="bankTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="text-center">Operation</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Bank</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Ref Number</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($userTransactions as $transaction)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td class="text-center">
                            {{ $transaction->operation }}
                        </td>
                        <td class="text-center">
                            {{ $transaction->amount }} $
                        </td>
                        <td class="text-center">
                            <a href="{{ route('atm.account.show', $transaction->account->id) }}">
                                {{ $transaction?->account?->account_number }}
                            </a>
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
                            <p class="my-4">
                                No Transactions Exists Yet
                            </p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <p class="border-bottom">Accounts List </p>
    <div class="row g-4">
        <!--List All Account  -->
        @foreach($userAccounts as $account)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="fw-normal">
                                Balance : <span
                                    class="badge bg-label-info"> {{ $account->balance }} $</span>
                            </h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-sm pull-up" aria-label="Sophia Head"
                                    data-bs-original-title="Sophia Head">
                                    <img class="rounded-circle"
                                         src="{{ asset('assets/img/favicon/favicon.png')  }}"
                                         alt="{{ $account->holder_name }}">
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex  mb-2">
                            <div class="role-heading">
                                <a href="{{ route('atm.account.show', $account->id) }}">
                                    {{ $account->account_number }}
                                </a>
                            </div>
                        </div>

                        <div class="d-flex my-3 justify-content-between align-items-end">
                            <h5 class="text-muted my-3">
                                {{ $account->holder_name }}
                            </h5>
                            <a href="{{ route('atm.account.show', $account->id) }}" class="text-muted"><i
                                    class="bx bx-show"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!--Create New Currency -->
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                            <img src="{{asset('assets/img/illustrations/superman-flying-light.png')}}"
                                 class="img-fluid"
                                 alt="{{__('settings.currencies.create new currency')}}" width="120">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a href="javascript:(0);" class="btn btn-outline-primary mb-3 text-nowrap add-new-role"
                               data-bs-toggle="modal" data-bs-target="#accountForm">
                                <span class="d-none d-sm-inline-block">
                                 Create New Account
                                </span>
                                <i class="bx bx-plus me-0 me-sm-1"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('home.inc.create')


@endsection




