<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffectationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'affectation_id',
        'action',
        'user',
        'nom_employee',
        'telephone_N',
        'department_name',
        'application1',
        'application2',
        'application3',
        'application4',
        'date_debut',
        'date_fin',
    ];

    // Vous pouvez ajouter des relations ou des méthodes personnalisées ici si nécessaire
}
