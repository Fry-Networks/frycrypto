<?php

namespace App\Http\Controllers;

use App\Models\MinerDevices;
use App\Services\AlgorandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExplorerController extends Controller
{
    protected AlgorandService $algorand_service;

    public function __construct(AlgorandService $algorandService)
    {
        $this->algorand_service = $algorandService;
    }

    public function dashboard()
    {
        return view('explorer.index');
    }

    public function miners(Request $request)
    {
        $miners = MinerDevices::query();
        if ($request->has('type')) {
            $miners->where('type', $request->get('type'));
        }
        $types = MinerDevices::query()->select('type')->distinct()->pluck('type');
        $miners = $miners->paginate(25);
        return view('explorer.miners', compact('miners', 'types'));
    }

    public function viewMiner($id)
    {
        $miner = MinerDevices::query()->findOrFail($id);
        return view('explorer.view-miner',compact('miner'));
    }

    public function blocks()
    {
        $page = 'blocks';
        return view('explorer.results-page',compact('page'));
    }
    public function viewBlock($id)
    {
        $block = $this->algorand_service->getBlock($id);
        return view('explorer.view-block',compact('block'));
    }

    public function accounts(Request $request)
    {
        $page = 'accounts';
        return view('explorer.results-page', compact('page'));
    }
    public function viewAccount($id)
    {
        $account = $this->algorand_service->getAccount($id);
        return view('explorer.view-account',compact('account'));
    }


    public function transactions(Request $request)
    {
        $page = 'transactions';
        return view('explorer.results-page', compact('page'));
    }

    public function viewTransaction($id)
    {
        $transaction = $this->algorand_service->getTransaction($id);
        return view('explorer.view-transaction',compact('transaction'));
    }

    public function viewMap()
    {
        $locations = DB::table('miner_devices')->select('lat', 'lng')->get();
        $points = $locations->map(function ($location) {
            return [$location->lat, $location->lng];
        })->toArray();
        return view('explorer.map')->with(['points' => json_encode($points)]);
    }

    public function getHexDetails(Request $request)
    {
        $locations = $request->get('locations');
        $points = json_decode($locations);
        foreach ($points as $point) {
            $miner = MinerDevices::query()->where('lat', $point[0])->where('lng', $point[1])->first();
        }

        $miners = MinerDevices::query()->where('hex', $hex)->get();
        $view = view('explorer.partials.hexagon-details', compact('miners'))->render();
        return response()->json($view);
    }
}
