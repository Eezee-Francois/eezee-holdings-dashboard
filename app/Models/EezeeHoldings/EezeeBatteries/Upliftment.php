<?php

namespace App\Models\EezeeHoldings\EezeeBatteries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upliftment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'truck_id',
        'driver_id',
        'upliftment_day_id',
        'completed',    
        'date',
        'start_time',
        'end_time',
        // Add any other attributes that need to be mass assignable
    ];
}
