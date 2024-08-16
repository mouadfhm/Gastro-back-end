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
            if(Clinique::where('name', $request->name)->exists()) {
                return[
                    'error' => 'Clinique already exists',
                    'status' => 500
                ];
            }
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

    public function delete(Request $request)
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
            $clinique = Clinique::find($request->name);
            $clinique->delete();
            return[
                'payload' => $clinique,
                'status' => 200,    
                'message' => 'Clinique deleted successfully'
            ];
        } catch (\Exception $e) {
            return[
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
}
