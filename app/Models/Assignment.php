<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    /** @use HasFactory<\Database\Factories\AssignmentFactory> */
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'assignmentEnd_id',
        'km_traveled',
        'machine_id',
        'work_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function assignmentEnd()
    {
        return $this->belongsTo(AssignmentEnd::class, 'assignmentEnd_id');
    }
}
