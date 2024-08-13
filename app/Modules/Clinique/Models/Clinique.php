<?php

namespace App\Modules\Clinique\Models;

use App\Modules\Geste\Models\Geste;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Clinique extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','created_at','updated_at'];

    public function Geste()
    {
        return $this->hasMany(Geste::class);
    }
}
