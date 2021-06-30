<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administration ;
use App\Models\PatientMedicine;
use Illuminate\Support\Facades\DB;

class AdministrationController extends Controller
{
    public function index()
    {

        $patient_medicines = PatientMedicine::Active()->DoseAmountNull()->paginate(PAGINATION_COUNT);
        $administrations  = Administration::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
    //    return $administrations ;

        return view('Admin.administrations.index', compact('patient_medicines','administrations'));
    }

    public function update($id)
    {
        try {
            DB::beginTransaction();
        //update Time PatientMedicine;
        $patient_medicines = PatientMedicine::find($id);
        $patient_medicines->updated_at =now();
        $patient_medicines->doseAmount -=1;
        $patient_medicines->save();
        //End update Time PatientMedicine


        //Create Row in Administration
        $Administration = new Administration;
        $Administration->prescription_id= $id;
        $Administration->nurse_id = auth()->user()->id;
        $Administration->save();
        //End Create Row in Administration

        //start logs
        logss("update Row in Patient Medicine");
        //End Logs
        DB::commit();
        return redirect()->route('administrations.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('administrations.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }


    }
}
