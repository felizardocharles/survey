<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'picture'
    ];

    /* Condição de "Employee" em relação a "Assessment"
    Regra: Um Employee possui vários Assessment (pode ser referenciado em vários Assessment)
    Define nome da function no plural
    */
    public function assessments()
    {
        return $this->hasMany(assessment::class);
    }
}
