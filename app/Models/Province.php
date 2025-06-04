<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /** @use HasFactory<\Database\Factories\ProvinceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'postal_code',
    ];

    public function machines()
    {
        return $this->hasMany(Machine::class, 'current_province');
    }
}
