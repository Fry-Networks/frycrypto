<div>
    <div class="table-responsive">
        <div class="form-group d-flex col-md-4  flex-nowrap align-items-center">
            <label for="tx_type" class="w-25">Tx Type</label>
            <select class="form-control form-select border-0" style="background-color: #ececec"
                    wire:change="getTransactions('', $event.target.value)">
                <option value="pay" {{$transactionType == 'pay' ? 'selected':''}}>Pay</option>
                <option value="keyreg" {{$transactionType == 'keyreg' ? 'selected':''}}>Key Registration</option>
                <option value="acfg" {{$transactionType == 'acfg' ? 'selected':''}}>Asset Configuration</option>
                <option value="axfer" {{$transactionType == 'axfer' ? 'selected':''}}>Asset Transfer</option>
                <option value="afrz" {{$transactionType == 'afrz' ? 'selected':''}}>Asset Freeze</option>
                <option value="appl" {{$transactionType == 'appl' ? 'selected':''}}>Application Call</option>
                <option value="stpf" {{$transactionType == 'stpf' ? 'selected':''}}>State Proof</option>
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
                        <a href="{{route('explorer.view-transaction', $transaction['id'])}}">{{ secretString($transaction['id']) }}</a>
                    </td>
                    <td>{{ $transaction['confirmed-round'] }}</td>
                    <td>
                        <span class="badge bg-warning px-3">{{ucfirst($transaction['tx-type'])}}</span>
                    </td>
                    <td>{{formatAgeFromTimestamp($transaction['round-time'])}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div class="pagination-container">
        @if($page > 1)
            <button wire:click="getTransactions('prev')">&lt;</button>
        @endif
        <button class="active">{{$page}}</button>
        @if($nextToken)
            <button wire:click="getTransactions('next')">&gt;</button>
        @endif
    </div>


</div>
