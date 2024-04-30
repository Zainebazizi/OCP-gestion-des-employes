<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'code_matricule','telephone_N', 'application1', 'application2', 'application3', 'application4', 'date_debut', 'date_fin'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function telephone()
    {
        return $this->belongsTo(Telephone::class);
    }
}
