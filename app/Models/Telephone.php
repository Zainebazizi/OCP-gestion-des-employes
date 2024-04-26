<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use HasFactory;
    protected $fillable = ['marque', 'modele','status','num_série'];

    public function affectations()
    {
        return $this->hasMany(Affectation::class);
    }
    public function applications()
    {
        return $this->hasManyThrough(Application::class, Installation::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function installations()
    {
        return $this->hasMany(Installation::class);
    }
}
