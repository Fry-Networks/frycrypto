<div>
    <div class="table-responsive" id="blocks_table">
        <div wire:loading class="loading-indicator">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
        <table class="table"  wire:loading.remove>
            <thead>
            <tr>
                <th>Height</th>
                <th>Block Hash</th>
                <th>Transactions</th>
                <th>Age</th>
            </tr>
            </thead>
            <tbody>
            @foreach($blocks as $block)
                <tr>
                    <td class="text-success fw-bold">akdjfskfjskdf</td>
                    <td>150,401</td>
                    <td>
                        <span class="badge bg-warning px-3">TX_Report</span>
                    </td>
                    <td>1 mins 2 secs ago</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-container">
        @if($page > 1)
            <button wire:click="getBlocks('prev')">&lt;</button>
        @endif
        <button class="active">{{$page}}</button>
        @if($nextToken)
            <button wire:click="getBlocks('next')">&gt;</button>
        @endif
    </div>
</div>
