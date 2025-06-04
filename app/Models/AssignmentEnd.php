<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentEnd extends Model
{
    /** @use HasFactory<\Database\Factories\AssignmentEndFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function assignment()
    {
        return $this->hasMany(Assignment::class);
    }
}
