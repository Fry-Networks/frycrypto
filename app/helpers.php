<?php

use App\Models\Transaction;
use App\Services\AlgonodeService;
use Illuminate\Support\Facades\DB;

function formatAge($age_in_rounds): string
{
    $seconds_per_round = 1;
    $age_in_seconds = $age_in_rounds * $seconds_per_round;

// Convert age in seconds to other units
    $age_in_minutes = $age_in_seconds / 60;
    $age_in_hours = $age_in_minutes / 60;
    $age_in_days = $age_in_hours / 24;

    return floor($age_in_days) . ' days ' . floor($age_in_hours % 24) . ' hours ' . floor($age_in_minutes % 60) . ' minutes ';
}

function formatAgeFromTimestamp($timestamp): string
{
    $age_timestamp = $timestamp;
    $age = time() - $age_timestamp;  // Age in seconds
    $age_in_minutes = floor($age / 60);
    $age_in_hours = floor($age_in_minutes / 60);
    $age_in_days = floor($age_in_hours / 24);

    return $age_in_days . ' days ' . $age_in_hours % 24 . ' hours ' . $age_in_minutes % 60 . ' minutes';
}


function secretString($string): string
{
    return substr($string, 0, 6) . "..." . substr($string, -6);
}


if (! function_exists('populateLatLng')) {
    function populateLatLng(): void
    {
        $devices = DB::table('miner_devices')->get();

        foreach ($devices as $device) {
            // Generate a random latitude between 49.959999 and 58.635000
            $lat = mt_rand(49960000, 58635000) / 1000000;
            // Generate a random longitude between -7.572167 and 1.681531
            $lng = mt_rand(-7572167, 1681531) / 1000000;

            DB::table('miner_devices')
                ->where('id', $device->id)
                ->update([
                    'lat' => $lat,
                    'lng' => $lng
                ]);
        }
    }
}

function updateAllTransactionsOfAddress($address)
{
    $round_time = Transaction::query()->where('sender', $address)->max('round_time') ?? 0;
    $algo_node = new AlgonodeService();

    $nextRound = $round_time;
    $limit = 100;

    do {
        $transactions = $algo_node->fetchTransactions([
            'address' => $address,
            'min-round' => $nextRound,
            'note-prefix' => 'Q29ubmVjdGl2aXR5IENoZWNrIGZv',
            'limit' => $limit,
            'next' => $nextToken ?? ''
        ]);
        if ($transactions && !empty($transactions['transactions']) && !empty($transactions['next-token'])) {
            $nextToken = $transactions['next-token'];
            $insertData = [];

            foreach ($transactions['transactions'] as $transaction) {
                if (!Transaction::where('transaction_id', $transaction['id'])->exists()) {
                    $insertData[] = [
                        'transaction_id' => $transaction['id'],
                        'sender' => $transaction['sender'],
                        'tx_type' => $transaction['tx-type'],
                        'confirmed_round' => $transaction['confirmed-round'],
                        'round_time' => $transaction['round-time'],
                        'amount' => $transaction['amount'] ?? 0,
                        'receiver' => $transaction['receiver'] ?? null,
                        'note' => $transaction['note'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            if (!empty($insertData)) {
                Transaction::insert($insertData);
            }
        } else {
            break; // Break the loop if no transactions are returned
        }
    } while (true);
    return true;
}

function getTransactionsByNote($note)
{
    return Transaction::query()->where('note', $note)->orderBy('round_time')->get();
}
