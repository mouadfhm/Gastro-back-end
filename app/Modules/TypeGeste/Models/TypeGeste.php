<?php

namespace App\Modules\TypeGeste\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeGeste extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nom',
    ];
}
