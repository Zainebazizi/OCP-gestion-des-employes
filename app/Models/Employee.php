<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'numero', 'department', 'region', 'code_matricule'];
    public function affectations()
    {
        return $this->hasMany(Affectation::class);
    }
    public function history()
    {
        return $this->hasMany(History::class);
    }
}

