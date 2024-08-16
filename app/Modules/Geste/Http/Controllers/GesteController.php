<?php

namespace App\Modules\Geste\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Clinique\Models\Clinique;
use App\Modules\Geste\Models\Geste;
use App\Modules\Patient\Models\Patient;
use Illuminate\Auth\Events\Validated;

class GesteController
{
    public function index()
    {
        try {
            $gestes = Geste::with('Patient', 'Clinique')->get();
            return [
                'payload' => $gestes,
                'status' => 200
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }

    public function add(Request $request)
    {

        $rules = [
            'clinique_name' => 'required',
            'patient_firstname' => 'required',
            'patient_lastname' => 'required',
            'date' => 'required',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                'error' => $validator->errors(),
                'status' => 500
            ];
        }
        try {
            $clinique = Clinique::where('name', $request->clinique_name)->first();
            $patient = Patient::where('firstname', $request->patient_firstname)->where('lastname', $request->patient_lastname)->first();
            if (!$patient) {
                $patient = Patient::create([
                    'firstname' => $request->patient_firstname,
                    'lastname' => $request->patient_lastname,
                    'age' => $request->age,
                    'phone' => $request->phone,
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
            return [
                'payload' => $geste,
                'status' => 200,
                'message' => 'Geste added successfully'
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }

    public function update(Request $request)
    {

        $rules = [
            'id' => 'required',
            'clinique_name' => 'required',
            'patient_firstname' => 'required',
            'patient_lastname' => 'required',
            'date' => 'required',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                'error' => $validator->errors(),
                'status' => 500
            ];
        }
        try {
            $geste = Geste::find($request->id);
            if (!$geste) {
                return [
                    'error' => 'Geste not found',
                    'status' => 404
                ];
            }
            $patient = Patient::where('firstname', $request->patient_firstname)->where('lastname', $request->patient_lastname)->first();
            if (!$patient) {
                $patient = Patient::create([
                    'firstname' => $request->patient_firstname,
                    'lastname' => $request->patient_lastname,
                    'age' => $request->age,
                    'phone' => $request->phone,
                    'RC' => $request->RC,
                    'result' => $request->result
                ]); 
            }
            $geste->update([
                'patient_id' => $patient->id,
                'clinique_id' => $request->clinique_id,
                'date' => $request->date,
                'type' => $request->type,
                'result' => $request->result
            ]);
            return [
                'payload' => $geste,
                'status' => 200,
                'message' => 'Geste updated successfully'
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
    public function delete(Request $request)
    {
        $rules = [
            'id' => 'required',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                'error' => $validator->errors(),
                'status' => 500
            ];
        }
        try {
            $geste = Geste::find($request->id);
            if (!$geste) {
                return [
                    'error' => 'Geste not found',
                    'status' => 404
                ];
            }
            $geste->delete();
            return [
                'payload' => $geste,
                'status' => 200,
                'message' => 'Geste deleted successfully'
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 500
            ];
        }
    }
}
