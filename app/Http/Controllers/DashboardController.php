<?php

namespace App\Http\Controllers;

use App\Services\AlgonodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $encryptedValue = $request->address;
        if (!$encryptedValue) {
            return redirect()->route('verify-miner');
        }
        try {
            $address = Crypt::decryptString($encryptedValue);
        }catch (\Exception $exception){
            return redirect()->route('verify-miner');
        }
//        $address = '2H7P3YSSW5HE45K54U3LCG2QXOFM777LVQ7WIVW5BRNZMDKLE2KJ24TUUM';
        session(['algonode_address' => $address]);
        return view('dashboard.index')->with(['address' => $address]);
    }


    public function getTransactions(Request $request, $note)
    {
        return view('dashboard.transactions')->with(['note' => $note]);
    }

    public function viewTransaction(Request $request, $tx_id)
    {
        $algonode_service = new AlgonodeService();
        $transaction = $algonode_service->getTransaction($tx_id);
        return view('dashboard.view-transaction', compact('transaction'));
    }

}
