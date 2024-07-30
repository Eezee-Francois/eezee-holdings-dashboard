<?php

namespace App\Models\EezeeBatteries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'client_name',
        'telephone_1',
        'telephone_2',
        'email',
        'price',
        'province',
        'client_comments',
        'address',
        'lat',
        'lng',
        // Add any other attributes that need to be mass assignable
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2', // Ensures the price retains two decimal places
    ];
    
    public function getTelephone1Attribute($value)
    {
        return decrypt($value);
    }

    public function getTelephone2Attribute($value)
    {
        return decrypt($value);
    }

    public function getEmailAttribute($value)
    {
        return decrypt($value);
    }

    public function getAddressAttribute($value)
    {
        return decrypt($value);
    }

    public function getLatAttribute($value)
    {
        return decrypt($value);
    }

    public function getLngAttribute($value)
    {
        return decrypt($value);
    }
}
