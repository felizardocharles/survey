<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'grade'
    ];

    /* Condição de "Assessment" em relação a "Employee"
    Regra: Um Employee "tem vários" Assessment (hasMany lá no Employee),
    então como a FK employee_id está em assessments dizemos que Assessment
    "pertence a" Employee
    Define nome da function no singular
    */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
