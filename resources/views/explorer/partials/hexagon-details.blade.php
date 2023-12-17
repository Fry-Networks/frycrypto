<div class="modal-content" style="border-color: #e74646">
    <div class="modal-header" style="background-color: #fdd7d7;">
        <h4 class="modal-title" style=" color: #e74646 !important;">Hexagon #{{$index+1}}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                style=" color: #e74646 !important;"></button>
    </div>
    <div class="modal-body">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            @foreach($groupedMiners as $email=>$miners)
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center card-title">{{$loop->iteration}}</h4>
                        <hr>
                        @foreach($miners as $miner)
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-heading{{$miner->algorand_address}}-{{$loop->iteration}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            style="margin: 0 !important;"
                                            data-bs-target="#panelsStayOpen-collapse{{$miner->algorand_address}}-{{$loop->iteration}}"
                                            aria-expanded="false"
                                            aria-controls="panelsStayOpen-collapse{{$miner->algorand_address}}-{{$loop->iteration}}">
                                       <span class="miner-title"> Miner - {{$miner->type}}</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse{{$miner->algorand_address}}-{{$loop->iteration}}"
                                     class="accordion-collapse collapse"
                                     aria-labelledby="panelsStayOpen-heading{{$miner->algorand_address}}-{{$loop->iteration}}">
                                    <div class="accordion-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td><strong>Algorand Address</strong></td>
                                                    <td>{{$miner->algorand_address}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Type</strong></td>
                                                    <td>{{$miner->type}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <a href="{{route('explorer.view-miner', $miner->id)}}"
                                           class="btn btn-danger">View Miner
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
