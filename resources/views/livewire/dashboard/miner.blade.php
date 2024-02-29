<div class="d-flex justify-content-center align-items-center mb-3 w-100">

    <div class="accordion w-100">
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading_{{$loop->iteration}}">
                <button class="accordion-button" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#id_{{$loop->iteration}}"
                        aria-expanded="true" aria-controls="collapseOne">
                    Miner
                </button>
            </h2>
            <div id="id_{{$loop->iteration}}" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <div
                        class="d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-lighter">Address</div>
                        <div
                            class="fw-bold text-danger">{{$miner['address']}}</div>
                    </div>
                    <div
                        class="d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-lighter">On Board Time</div>
                        <div
                            class="text-dark fw-bold">{{ formatAgeFromTimestamp($miner['on_boarding']) }}</div>
                    </div>
                    <div
                        class="d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-lighter">Status</div>
                        <div class="text-dark fw-bold">
                            @if($miner['status'] == 'online')
                                <span class="status-circle bg-success"></span> Online
                            @elseif($miner['status'] == 'possible online')
                                <span class="status-circle bg-yellow"></span> Probably Online
                            @elseif($miner['status'] == 'possible offline')
                                <span class="status-circle bg-warning"></span> Probably Offline
                            @else
                                <span class="status-circle bg-danger"></span> Offline
                            @endif
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column justify-content-center align-items-start mb-3">
                        @include('dashboard.partials.rewards-chart')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
