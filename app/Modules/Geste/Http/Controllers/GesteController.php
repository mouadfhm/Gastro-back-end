<?php

namespace App\Modules\Geste\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Clinique\Models\Clinique;
use App\Modules\Geste\Models\Geste;
use App\Modules\Patient\Models\Patient;

class GesteController
{
    public function index()
    {
        try {
            $gestes = Geste::with('Patient', 'Clinique')->get();
            return[
                'patients' => $gestes,
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

        $rules=[
            'clinique_name' => 'required',
            'patient_firstname' => 'required',
            'patient_lastname' => 'required',
            'date' => 'required',
            'type' => 'required',
            'result' => 'required',
        ];
        $validator=Validator($request->all(),$rules);
        if ($validator->fails())    {
            return[
                'error' => $validator->errors(),
                'status' => 500
            ];
        }
        try {
            $clinique=Clinique::where('name', $request->clinique_name)->first();
            $patient=Patient::where('firstname', $request->patient_firstname)->where('lastname', $request->patient_lastname)->first();
            if(!$patient) {
                $patient = Patient::create([
                    'firstname' => $request->patient_firstname,
                    'lastname' => $request->patient_lastname,
                    'age' => $request->age,
                    'RC' => $request->RC,
                    'result' => $request->result
                ]);
            }
            $geste = Geste::create([
                'patient_id' => $patient->id,
                'clinique_id' => $clinique->id,
                'date' => $request->date,
                'type' => $request->type,
                'result' => $request->result
            ]);
            return[
                'payload' => $geste,
                'status' => 200,
                'message' => 'Geste added successfully'
            ];
        } catch (\Exception $e) {
            return[
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }

}
