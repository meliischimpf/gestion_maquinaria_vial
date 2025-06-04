<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineType extends Model
{
    /** @use HasFactory<\Database\Factories\MachineTypeFactory> */
    use HasFactory;
    
    protected $fillable = [
        'name',
        'function',
    ];

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }

}
