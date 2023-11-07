<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinerDevices extends Model
{
    use HasFactory;

    protected $guarded = [];

    CONST VALID_TYPES = [
        'Indoor Decibel',
        'Indoor Wildlife Camera',
        'Indoor Traffic Camera',
        'Indoor Sky Camera',
        'Indoor Pebble',
        'Bandwidth Hardware',
        'Satellite Hardware',
        'Satellite BYOD',
        'Bandwidth BYOD',
        'Outdoor Wildlife Camera',
        'Outdoor Traffic Camera',
        'Outdoor Sky Camera',
        'Outdoor Satellite Hardware',
        'Outdoor Decibel',
        'Outdoor Decibel BYOD',
        'Low End Weather Hardware',
        'High End Weather Hardware',
    ];
}
