<div class="row">
    <div class="col-xl-12 col-xxl-12 d-flex">
        <div class="w-100">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="table-responsive">
                            <div class="form-group d-flex col-md-4  flex-nowrap align-items-center">
                                <label for="tx_type" class="w-25">Tx Type</label>
                                <select class="form-control form-select border-0" style="background-color: #ececec" wire:model.live="transactionType">
                                    <option value="pay">Pay</option>
                                    <option value="keyreg">Key Registration</option>
                                    <option value="acfg">Asset Configuration</option>
                                    <option value="axfer">Asset Transfer</option>
                                    <option value="afrz">Asset Freeze</option>
                                    <option value="appl">Application Call</option>
                                    <option value="stpf">State Proof</option>
                                </select>
                            </div>
                            <hr/>
                            <div wire:loading class="loading-indicator">
                                <div class="spinner">
                                    <div class="double-bounce1"></div>
                                    <div class="double-bounce2"></div>
                                </div>
                            </div>
                            <table class="table" id="transactions_table" wire:loading.remove>
                                <thead>
                                <tr>
                                    <th>Hash</th>
                                    <th>Block</th>
                                    <th>Type</th>
                                    <th>Age</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <a href="{{route('dashboard.view-transaction', $transaction['transaction_id'])}}">{{ secretString($transaction['transaction_id']) }}</a>
                                        </td>
                                        <td>{{ $transaction['confirmed_round'] }}</td>
                                        <td>
                                            <span class="badge bg-warning px-3">{{ucfirst($transaction['tx_type'])}}</span>
                                        </td>
                                        <td>{{formatAgeFromTimestamp($transaction['round_time'])}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
