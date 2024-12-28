<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleFuelConsumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'fuel_type',
        'fuel_liters',
        'fuel_date'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'vehicle_id');
    }
}
