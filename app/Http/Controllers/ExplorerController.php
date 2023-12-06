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
        $miners_count = MinerDevices::query()->count();
        $types_count = [
            'Hardware Miners' => [
                'Bandwidth Hardware' => MinerDevices::query()->where('type', 'Bandwidth Hardware')->count(),
                'Satellite Hardware' => MinerDevices::query()->where('type', 'Satellite Hardware')->count(),
                'Low End Weather Hardware' => MinerDevices::query()->where('type', 'Low End Weather Hardware')->count(),
                'High End Weather Hardware' => MinerDevices::query()->where('type', 'High End Weather Hardware')->count(),
                'Outdoor Satellite Hardware' => MinerDevices::query()->where('type', 'Outdoor Satellite Hardware')->count(),
            ],
            'Byod Miners' => [
                'Satellite BYOD' => MinerDevices::query()->where('type', 'Satellite BYOD')->count(),
                'Bandwidth BYOD' => MinerDevices::query()->where('type', 'Bandwidth BYOD')->count(),
                'Outdoor Decibel BYOD' => MinerDevices::query()->where('type', 'Outdoor Decibel BYOD')->count(),
            ],
            'Other' => [
                'Indoor Decibel' => MinerDevices::query()->where('type', 'Indoor Decibel')->count(),
                'Outdoor Decibel' => MinerDevices::query()->where('type', 'Outdoor Decibel')->count(),
                'Indoor Wildlife Camera' => MinerDevices::query()->where('type', 'Indoor Wildlife Camera')->count(),
                'Indoor Traffic Camera' => MinerDevices::query()->where('type', 'Indoor Traffic Camera')->count(),
                'Indoor Sky Camera' => MinerDevices::query()->where('type', 'Indoor Sky Camera')->count(),
                'Indoor Pebble' => MinerDevices::query()->where('type', 'Indoor Pebble')->count(),
                'Outdoor Wildlife Camera' => MinerDevices::query()->where('type', 'Outdoor Wildlife Camera')->count(),
                'Outdoor Traffic Camera' => MinerDevices::query()->where('type', 'Outdoor Traffic Camera')->count(),
                'Outdoor Sky Camera' => MinerDevices::query()->where('type', 'Outdoor Sky Camera')->count(),
                'Other' => MinerDevices::query()->whereNotIn('type', MinerDevices::VALID_TYPES)->count(),
            ]
        ];
        $verified_count = MinerDevices::query()->where('lat', '!=', null)->count();
        $page_data = [
            'miners_count' => $miners_count,
            'types_count' => $types_count,
            'verified_count' => $verified_count,
        ];
        return view('explorer.index')->with($page_data);
    }

    public function miners(Request $request)
    {
        $miners = MinerDevices::query();
        if ($request->has('type') && $request->get('type') != 'all') {
            $miners->where('type', $request->get('type'));
        }
        $types = MinerDevices::query()->select('type')->distinct()->pluck('type');
        $miners = $miners->paginate(25);
        return view('explorer.miners', compact('miners', 'types'));
    }

    public function viewMiner($id)
    {
        $miner = MinerDevices::query()->findOrFail($id);
        return view('explorer.view-miner', compact('miner'));
    }

    public function blocks()
    {
        $page = 'blocks';
        return view('explorer.results-page', compact('page'));
    }

    public function viewBlock($id)
    {
        $block = $this->algorand_service->getBlock($id);
        return view('explorer.view-block', compact('block'));
    }

    public function accounts(Request $request)
    {
        $page = 'accounts';
        return view('explorer.results-page', compact('page'));
    }

    public function viewAccount($id)
    {
        $account = $this->algorand_service->getAccount($id);
        return view('explorer.view-account', compact('account'));
    }


    public function transactions(Request $request)
    {
        $page = 'transactions';
        return view('explorer.results-page', compact('page'));
    }

    public function viewTransaction($id)
    {
        $transaction = $this->algorand_service->getTransaction($id);
        return view('explorer.view-transaction', compact('transaction'));
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
        $points = [];
        foreach ($locations as $location) {
            $points[] = [$location[0], $location[1]];
        }
        $miners = collect();
        foreach ($points as $point) {
            $miner = MinerDevices::query()
                ->where('lat', $point[0])
                ->where('lng', $point[1])
                ->first();

            if ($miner) {
                $miners->push($miner);
            }
        }
        $index = $request->get('index');
        $groupedMiners = $miners->groupBy('email');

        $view = view('explorer.partials.hexagon-details', compact('groupedMiners', 'index'))->render();
        return response()->json($view);
    }
}
