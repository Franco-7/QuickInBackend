<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'trip_id',
        'status',
        'destination',
        'date',
        'start_time',
        'end_time',
        'real_start_time',
        'real_end_time',
        'reason',
        'vehicle_id',
        'employee_number',
    ];

    protected $primaryKey = 'trip_id';

    // public function user(){
    //     return $this->belongsTo('App\Models\User');
    // }
}
