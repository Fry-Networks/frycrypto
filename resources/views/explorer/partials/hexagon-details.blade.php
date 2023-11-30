<div class="modal-content" style="border-color: #e74646">
    <div class="modal-header" style="background-color: #fdd7d7;">
        <h4 class="modal-title" style=" color: #e74646 !important;">Hexagon #{{$index+1}}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                style=" color: #e74646 !important;"></button>
    </div>
    <div class="modal-body">
        @foreach($miners as $miner)
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            @php($exclude = ['id', 'created_at', 'updated_at', 'lat', 'lng'])
                            @foreach($miner->toArray() as $key => $value)
                                @if(!empty($value) && !in_array($key, $exclude))
                                    <tr>
                                        <td><strong>{{ucfirst($key)}}</strong></td>
                                        <td>{{$value}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{route('explorer.view-miner', $miner->id)}}" class="btn btn-danger">View Miner
                        Details</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
