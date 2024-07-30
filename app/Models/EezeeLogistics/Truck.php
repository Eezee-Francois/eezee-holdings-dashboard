<?php

namespace App\Models\EezeeLogistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    public function drivers()
    {
        return $this->belongsToMany('App\Models\EezeeLogistics\Driver', 'truck_drivers', 'truck_id', 'driver_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'registration',
        'size',
        // Add any other attributes that need to be mass assignable
    ];
}
