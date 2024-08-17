<?php

namespace App\Modules\TypeGeste\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\TypeGeste\Models\TypeGeste;

class TypeGesteController
{

    public function index()
    {
        try {
            $typeGeste = TypeGeste::all();
            return[
                'payload' => $typeGeste,
                'status' => 200
            ];
        } catch (\Exception $e) {
            return[
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
}
