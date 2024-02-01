<div class="container-fluid p-0" wire:init="loadMiners">
    <div wire:loading class="loading-indicator">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
        Fetching Data...
    </div>
    <div class="row" wire:loading.remove>
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4>Miners</h4>
                                    <h3 class="fw-bold">{{number_format($miners_count)}}</h3>
                                </div>
                                <img src="{{asset('assets/svgs/mining.svg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4>Verified</h4>
                                    <h3 class="fw-bold">{{number_format($verified_count)}}</h3>
                                </div>
                                <i class="align-middle" style="width: 35px; height: 35px"
                                   data-feather="check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h4>Un Verified</h4>
                                    <h3 class="fw-bold">{{number_format($miners_count - $verified_count)}}</h3>
                                </div>
                                <i class="align-middle" style="width: 35px; height: 35px"
                                   data-feather="loader"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Active Miners</h5>
                            @foreach($miners as $miner)
                                @livewire('dashboard.miner', ['miner' => $miner, 'loop' => $loop], key($miner['address']))
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
