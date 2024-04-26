<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalation extends Model
{
    use HasFactory;
    
    protected $fillable = ['application_id', 'telephone_id', 'date_installation'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function telephone()
    {
        return $this->belongsTo(Telephone::class);
    }
}
