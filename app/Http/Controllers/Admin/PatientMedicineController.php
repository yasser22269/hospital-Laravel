<?php

namespace App\Http\Controllers\Admin;

use App\Models\PatientMedicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientMedicineRequest;
use App\Models\Medicine;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class PatientMedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //permissions
        typePage("doctor");

        $patient_medicines = PatientMedicine::paginate(PAGINATION_COUNT);
        return view('Admin.patient_medicines.index', compact('patient_medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //permissions
        typePage("doctor");

        $Medicines = Medicine::get();
        $Patients = Patient::DischargedNull()->get();

        return view('Admin.patient_medicines.create', compact('Patients','Medicines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientMedicineRequest $request)
    {
       // return $request;
        try {
            DB::beginTransaction();
                $MedicineAmount = Medicine::find($request->medicine_id);
               // return $MedicineAmount;
                if($request->doseAmount <= $MedicineAmount->Amount){
                    $MedicineAmount->Amount -= $request->doseAmount ;
                    $MedicineAmount->save();
                }else{
                    DB::rollback();
                    return redirect()->back()->with(['error' => 'الكميه ليست كافيه فى المخزن']);
                }

                $request->request->add(['active' => 1]);

                PatientMedicine::create($request->except('_token'));
               //start logs
               logss("create Row in  PatientMedicine");
               //End Logs
                DB::commit();
                return redirect()->route('patient_medicines.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('patient_medicines.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function edit($id)
    {
        //permissions
        typePage("doctor");
        
        $PatientMedicine =PatientMedicine::find($id);
        $Medicines = Medicine::get();
        $Patients = Patient::DischargedNull()->get();
        return view('Admin.patient_medicines.edit', compact('PatientMedicine',"Medicines","Patients"));
    }

    public function update(PatientMedicineRequest $request,$id)
    {
     //   return  $request;
        try {

            DB::beginTransaction();
            $PatientMedicine = PatientMedicine::find($id);
            if (! isset($request->active) ){
                $request->request->add(['active' =>0 ]);
            }else
                 $request->request->add(['active' =>1 ]);

           $PatientMedicine->update($request->all());
            //start logs
            logss("update Row in  PatientMedicine");
            //End Logs
            DB::commit();
            return redirect()->route('patient_medicines.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('patient_medicines.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy( $id)
    {
        $PatientMedicine = PatientMedicine::find($id);
        if (!$PatientMedicine)
            return redirect()->route('patient_medicines.index')->with(['error' => 'هذا الماركة غير موجود ']);

            $MedicineAmount = Medicine::find($PatientMedicine->medicine_id);
                 $MedicineAmount->Amount += $PatientMedicine->doseAmount ;
                 $MedicineAmount->save();
            //start logs
            logss("delete Row in  PatientMedicine");
            //End Logs
        $PatientMedicine->delete();
        return redirect()->route('patient_medicines.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
