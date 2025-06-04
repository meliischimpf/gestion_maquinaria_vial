<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Machine;
use App\Models\MaintenanceTypes;

class Maintenance extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceFactory> */
    use HasFactory;

    protected $fillable = [
        'realization_date',
        'machine_id',
        'km_at_maintenance',
        'maintenanceType_id',
    ];

    
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function type()
    {
        return $this->belongsTo(MaintenanceType::class, 'maintenanceType_id');
    }
}
