<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /** @use HasFactory<\Database\Factories\StatusFactory> */
    use HasFactory;

    // id situation

    protected $fillable = [
        'situation',
    ];

    public function machines()
    {
        return $this->hasMany(Machine::class, 'status_id');
    }


    /* const SITUATION = [
        '0' => 'Inactivo',
        '1' => 'Activo',
        '2' => 'En Espera',
        '3' => 'En Funcionamiento',
        '4' => 'En Mantenimiento',
        '5' => 'Finalizado',
    ]; */
}
