<?php

namespace App\Modules\Patient\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Patient\Models\Patient;
use Dotenv\Validator;

class PatientController
{
    public function index()
    {
        try {
            $patients = Patient::all();
            return[
                'payload' => $patients,
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
            'firstname' => 'required',
            'lastname' => 'required',
        ];
        $validator=Validator($request->all(),$rules);
        if ($validator->fails())    {
            return[
                'error' => $validator->errors(),
                'status' => 500
            ];
        }
        try {
            $patient = Patient::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'age' => $request->age,
                'phone' => $request->phone,
                'RC' => $request->RC,
                'result' => $request->result
            ]);
            return[
                'payload' => $patient,
                'status' => 200,
                'message' => 'Patient added successfully'
            ];
        } catch (\Exception $e) {
            return[
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
    public function update(Request $request)
    {
        $rules=[
            'firstname' => 'required',
            'lastname' => 'required',
        ];
        $validator=Validator($request->all(),$rules);
        if ($validator->fails())    {
            return[
                'error' => $validator->errors(),
                'status' => 500
            ];
        }
        try {
            $patient = Patient::find($request->id);
            if(!$patient) {
                return[
                    'error' => 'Patient not found',
                    'status' => 404
                ];
            }
            $patient->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'age' => $request->age,
                'phone' => $request->phone,
                'RC' => $request->RC,
                'result' => $request->result
            ]);
            return[
                'payload' => $patient,
                'status' => 200,
                'message' => 'Patient updated successfully'
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
        $rules=[
            'firstname' => 'required',
            'lastname' => 'required',
        ];
        $validator=Validator($request->all(),$rules);
        if ($validator->fails())    {
            return[
                'error' => $validator->errors(),
                'status' => 500
            ];
        }
        try {
            $patient = Patient::where('firstname', $request->firstname)->where('lastname', $request->lastname)->first();
            if(!$patient) {
                return[
                    'error' => 'Patient not found',
                    'status' => 404
                ];
            }
            $patient->delete();
            return[
                'payload' => $patient,
                'status' => 200,
                'message' => 'Patient deleted successfully'
            ];
        } catch (\Exception $e) {
            return[
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
}
