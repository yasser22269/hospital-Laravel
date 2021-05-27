<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChangesBed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientsRequest;
use App\Models\Patient;
use App\Models\Room;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;

class ChangesBedController extends Controller
{

    public function edit( $id)
    {
        $patient =Patient::find($id);
        $Wards =Ward::get();

        return view('Admin.patients.changeBed', compact('patient','Wards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChangesBed  $changesBed
     * @return \Illuminate\Http\Response
     */
    public function update(PatientsRequest $request, $id)
    {
       // return $request;
        try {
            DB::beginTransaction();
            $Patient = Patient::find($id);

            if (isset($request->isIsolted) && $request->isIsolted == 1)
                $request->request->add(['isIsolted' => 1]);
            else
                $request->request->add(['isIsolted' => 0]);

                $request->request->add(['discharged' => null]);
                
                $room = Room::find($request->room);

                $room_id = Room::find($Patient->bed->room_id);
                $rooms = DB::select('select b.id from beds b WHERE  b.room_id ='.$room_id->id .' AND b.id IN(SELECT p.bed_id from patients p where p.bed_id = b.id OR p.discharged = NULL OR p.isIsolted =1)');
                if(count($rooms) == 1){
                    $room_id->type_id = 'free';
                    $room_id->save();
                }
                
                if($request->gender =="male" && $room->type_id =="free" ){
                    $room->type_id = 'blue';
                    $room->save();
                }else if($request->gender =="female" && $room->type_id =="free" ){
                    $room->type_id = 'red';
                    $room->save();
                }
                

                $ChangesBed = new ChangesBed;
                $ChangesBed->patient_id = $request->id;
                $ChangesBed->fromBed_id = $Patient->bed_id;
                $ChangesBed->toBed_id = $request->bed_id;
                $ChangesBed->save();

                //End Change bed

                $Patient->update($request->except('_token',"room","_method"));


                DB::commit();
                return redirect()->route('Patients.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Patients.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    
}
