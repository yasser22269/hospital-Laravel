<?php

namespace App\Http\Controllers\Admin;

use App\Models\Surgery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SurgeryRequest;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class SurgeryController extends Controller
{
    public function index()
    {
                 //permissions
                 typePage("doctor");

        $surgeries = Surgery::with('doctorName')->paginate(PAGINATION_COUNT);
        return view('Admin.surgeries.index', compact('surgeries'));
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

        $Patients = Patient::get();

        return view('Admin.surgeries.create', compact( 'Patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurgeryRequest $request)
    {
        //return $request;
      //try {
            DB::beginTransaction();

            //return $request->medicine_id ;

        // Start chack if doctor in Surgery
        $doctor_Surgeries = Surgery::where('doctor_id',$request->doctor_id)->get();
            $request->startTime = date('Y-m-d H:i:s', strtotime( $request->startTime));
            $request->endTime = date('Y-m-d H:i:s', strtotime( $request->endTime));
            foreach ($doctor_Surgeries as $doctor_Surgery) {
        if(($request->startTime >= $doctor_Surgery->startTime) && ($request->startTime <= $doctor_Surgery->endTime ) || ($request->endTime >= $doctor_Surgery->startTime) && ($request->endTime <= $doctor_Surgery->endTime ))
                return redirect()->route('Surgeries.index')->with(['error' =>  'سوف يكون الدكتور فى موعد فى هذا المعاد']);
        }
        // End chack if doctor in Surgery

        // Start chack if patient in Surgery
        $patient_Surgeries = Surgery::where('patient_id',$request->patient_id)->get();
            $request->startTime = date('Y-m-d H:i:s', strtotime( $request->startTime));
            $request->endTime = date('Y-m-d H:i:s', strtotime( $request->endTime));
            foreach ($patient_Surgeries as $patient_Surgery) {
        if(($request->startTime >= $patient_Surgery->startTime) && ($request->startTime <= $patient_Surgery->endTime ) || ($request->endTime >= $patient_Surgery->startTime) && ($request->endTime <= $patient_Surgery->endTime ))
                return redirect()->route('Surgeries.index')->with(['error' =>  'سوف يكون المريض فى موعد فى هذا المعاد']);
        }
        // End chack if patient in Surgery


            Surgery::create($request->except('_token'));
        //start logs
             logss("insert Row in  Surgery");
        //End Logs
            DB::commit();
            return redirect()->route('Surgeries.index')->with(['success' => 'تم ألاضافة بنجاح']);
    //    } catch (\Exception $ex) {
    //        DB::rollback();
    //        return redirect()->route('Surgeries.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    //    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //permissions
         typePage("doctor");

        $Patients = Patient::get();
        $Surgery = Surgery::find($id);

        return view('Admin.surgeries.edit', compact('Patients',"Surgery"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(SurgeryRequest $request, $id)
    {
       // return $request;
       try {
            DB::beginTransaction();
            $DoctorSchedule = Surgery::find($id);

        // Start chack if doctor in Surgery
        $doctor_Surgeries = Surgery::where('doctor_id',$request->doctor_id)->get();
        $request->startTime = date('Y-m-d H:i:s', strtotime( $request->startTime));
        $request->endTime = date('Y-m-d H:i:s', strtotime( $request->endTime));
        foreach ($doctor_Surgeries as $doctor_Surgery) {
        if((($request->startTime >= $doctor_Surgery->startTime) && ($request->startTime <= $doctor_Surgery->endTime ) || ($request->endTime >= $doctor_Surgery->startTime) && ($request->endTime <= $doctor_Surgery->endTime )) && $DoctorSchedule->id != $doctor_Surgery->id)
                return redirect()->route('Surgeries.index')->with(['error' =>  'سوف يكون الدكتور فى موعد فى هذا المعاد']);
        }
        // End chack if doctor in Surgery

        // Start chack if patient in Surgery
        $patient_Surgeries = Surgery::where('patient_id',$request->patient_id)->get();
            $request->startTime = date('Y-m-d H:i:s', strtotime( $request->startTime));
            $request->endTime = date('Y-m-d H:i:s', strtotime( $request->endTime));
            foreach ($patient_Surgeries as $patient_Surgery) {
        if((($request->startTime >= $patient_Surgery->startTime) && ($request->startTime <= $patient_Surgery->endTime ) || ($request->endTime >= $patient_Surgery->startTime) && ($request->endTime <= $patient_Surgery->endTime ))  && $DoctorSchedule->id != $patient_Surgeries->id)
                return redirect()->route('Surgeries.index')->with(['error' =>  'سوف يكون المريض فى موعد فى هذا المعاد']);
        }
        // End chack if patient in Surgery



             $DoctorSchedule->update($request->all());

            //start logs
            logss("update Row in  Surgery");
            //End Logs
            DB::commit();
            return redirect()->route('Surgeries.index')->with(['success' => 'تم التعديل بنجاح']);
       } catch (\Exception $ex) {
           DB::rollback();
           return redirect()->route('Surgeries.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
       }
    }
    public function show($id)
    {
    $Surgery = Surgery::find($id);
    return view('Admin.surgeries.show', compact("Surgery"));

    }
    public function destroy($id)
    {


        $DoctorSchedule = Surgery::find($id);
                    //start logs
                    logss("Delete Row in  Surgery");
                    //End Logs
        if (!$DoctorSchedule)
        return redirect()->route('Surgeries.index')->with(['error' => 'هذا الماركة غير موجود ']);
        $DoctorSchedule->delete();
        return redirect()->route('Surgeries.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
