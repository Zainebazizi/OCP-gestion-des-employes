<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'telephone_id', 'application_id', 'date_debut', 'date_fin'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function telephone()
    {
        return $this->belongsTo(Telephone::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
