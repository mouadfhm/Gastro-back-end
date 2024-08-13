<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geste extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'Patient_id', 'Clinique_id', 'type', 'date', 'created_at', 'updated_at'];

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function Clinique()
    {
        return $this->belongsTo(Clinique::class);
    }
}
