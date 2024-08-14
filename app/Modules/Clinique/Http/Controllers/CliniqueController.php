<?php

namespace App\Modules\Clinique\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Clinique\Models\Clinique;

class CliniqueController
{
    public function index()
    {
        try {
            $cliniques = Clinique::all();
            return[
                'payload' => $cliniques,
                'status' => 200
            ];
        } catch (\Exception $e) {
            return[
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }

    public function add(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $validator=Validator($request->all(),$rules);
        if ($validator->fails())    {
            return[
                'error' => $validator->errors(),
                'status' => 500
            ];
        }
        try {
            $clinique = new Clinique();
            $clinique->name = $request->name;
            $clinique->save();
            return[
                'payload' => $clinique,
                'status' => 200,
                'message' => 'Clinique added successfully'
            ];
        } catch (\Exception $e) {
            return[
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
}
