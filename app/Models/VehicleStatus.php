<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'status_id',
        'trip_id',
        'vehicle_id',
        'kilometres',
        'fuel_used'
    ];

    protected $primaryKey = 'status_id';
}
