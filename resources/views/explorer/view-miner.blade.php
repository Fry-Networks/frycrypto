@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <div class="container mt-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#miner">Miner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#report">Report</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="miner" class="container tab-pane active">
                <h3>Miner</h3>
                <p><strong>Miner:</strong> 0xe96F34D84fd78c1b52b293D960850d41aB0853651d</p>
                <p><strong>Type:</strong> Remote Miner</p>
                <p><strong>Status:</strong> Normal</p>
                <p><strong>Total Reward:</strong> 0 AKRE</p>
                <p><strong>Energy:</strong> 0 Wh</p>
                <p><strong>Peak Power:</strong> 0 W</p>
                <p><strong>Owner:</strong> 0x3343E...F30763</p>
                <p><strong>Maker:</strong> Arkreen</p>
                <p><strong>Onboarding Time:</strong> 34 mins 56 secs ago</p>
                <p><strong>Expired Time:</strong> 364 days 23 hrs after</p>
            </div>
            <div id="report" class="container tab-pane fade">
                <h3>Report</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Hash</th>
                        <th>Height</th>
                        <th>Power(W)</th>
                        <th>Energy(kWh)</th>
                        <th>Age</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>f1bb673...83ab0be</td>
                        <td>221,572</td>
                        <td>0</td>
                        <td>0</td>
                        <td>34 mins 51 secs ago</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
