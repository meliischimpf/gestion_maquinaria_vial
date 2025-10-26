<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    /** @use HasFactory<\Database\Factories\MachineFactory> */
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'type_id',
        'brand',
        'model',
        'status_id',
        'current_km',
        'lifetime_km',
        'image',
    ];

    public function type()
    {
        return $this->belongsTo(MachineType::class, 'type_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
    public function parameters()
    {
        return $this->hasMany(Parameter::class);
    }
    
}
