<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceTypesFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
