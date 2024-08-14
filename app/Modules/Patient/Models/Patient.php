<?php

namespace App\Modules\Patient\Models;

use App\Modules\Geste\Models\Geste;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 
        'firstname',
        'lastname', 
        'age', 
        'phone',
        'RC', 
        'result', 
        'created_at', 
        'updated_at'
    ];

    public function Geste()
    {
        return $this->hasMany(Geste::class);
    }

}
