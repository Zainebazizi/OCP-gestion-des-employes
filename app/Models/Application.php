<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'version'];

    public function installations()
    {
        return $this->hasMany(Installation::class);
    }
}
