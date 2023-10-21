<div>
    <div class="table-responsive">
        <div wire:loading class="loading-indicator">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
        <table class="table"  wire:loading.remove>
            <thead>
            <tr>
                <th>Address</th>
                <th>Reward(tAKRE)</th>
                <th>Type</th>
                <th>Age</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
                <tr>
                    <td class="text-danger fw-bold">
                        <a href="{{route('explorer.view-account', $account['address'])}}">{{secretString($account['address'])}}</a>
                    </td>
                    <td>{{number_format($account['rewards'], 2)}}</td>
                    <td>
                        <span
                            class="badge {{$account['status'] == 'Offline' ? 'bg-danger' : 'bg-success'}} px-3">{{$account['status']}}</span>
                    </td>
                    <td>{{formatAge($account['created-at-round'])}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        @if($page > 1)
            <button wire:click="getAccounts('prev')">&lt;</button>
        @endif
        <button class="active">{{$page}}</button>
        @if($nextToken)
            <button wire:click="getAccounts('next')">&gt;</button>
        @endif
    </div>
</div>
