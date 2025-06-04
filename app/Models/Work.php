<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    /** @use HasFactory<\Database\Factories\WorkFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'province_id',
        'start_date',
        'end_date_planned',
        'end_date_real',
        'description',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
