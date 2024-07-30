<?php

namespace App\Models\EezeeLogistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    public function trucks()
    {
        return $this->belongsToMany('App\Models\EezeeLogistics\Truck', 'truck_drivers', 'driver_id', 'truck_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'drivers_license',
        // Add any other attributes that need to be mass assignable
    ];
}
