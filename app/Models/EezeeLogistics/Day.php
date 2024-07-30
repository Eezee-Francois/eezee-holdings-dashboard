<?php

namespace App\Models\EezeeLogistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public function driver()
    {
    	return $this->belongsTo(Driver::class);
    }
}
