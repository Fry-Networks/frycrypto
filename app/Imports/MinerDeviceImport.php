<?php

namespace App\Imports;

use App\Models\MinerDevices;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MinerDeviceImport implements ToModel, WithHeadingRow
{
    protected string $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function model(array $row)
    {
        if (empty($row['algorand_address'])) return null;
        if (MinerDevices::query()->where('algorand_address', $row['algorand_address'])
            ->when(isset($row['email']), function ($q) use ($row) {
                $q->where('email', $row['email']);
            })->exists()) return null;
        return new MinerDevices([
            'email' => $row['email'] ?? '',
            'license_number' => $row['license_number'] ?? '',
            'order_number' => $row['order_number'] ?? '',
            'algorand_address' => $row['algorand_address'],
            'first_and_last_name' => $row['first_last_name'] ?? '',
            'imei_number' => $row['imei_umber'] ?? '',
            'miner_key' => $row['miner_key'] ?? '',
            'byod_license_key' => $row['Byod License Key'] ?? '',
            'RTSP_link' => $row['RTSP Link'] ?? '',
            'mac' => $row['MAC'] ?? '',
            'type' => $this->type,
        ]);
    }
}
