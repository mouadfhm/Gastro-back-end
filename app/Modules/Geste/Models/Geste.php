<?php

namespace App\Modules\Geste\Models;

use App\Modules\Clinique\Models\Clinique;
use App\Modules\Patient\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Geste extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'patient_id', 'clinique_id', 'type', 'date', 'created_at', 'updated_at'];

    public function Patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function Clinique()
    {
        return $this->belongsTo(Clinique::class);
    }
}
