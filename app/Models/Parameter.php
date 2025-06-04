<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    /** @use HasFactory<\Database\Factories\ParameterFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'description',
    ];

    public static function getValue(string $paramName): ?string
    {
        $parameter = self::where('name', $paramName)->first();

        return $parameter ? $parameter->value : null;
    }

}


