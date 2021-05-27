<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patinet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientsRequest;
use App\Models\Bed;
use App\Models\Patient;
use App\Models\Room;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{

    public function index()
    {
        $patients = Patient::paginate(PAGINATION_COUNT);
        return view('Admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Wards = Ward::get();

        $rooms = DB::select('select r.id , r.name  from rooms r where r.id  Not 
        in(select b.room_id from beds b WHERE b.room_id = r.id And
		 b.id IN(SELECT p.bed_id from patients p where p.bed_id = b.id AND p.discharged != NULL
		 AND p.discharged != "0000-00-00 00:00:00"
        OR p.isIsolted =1
        ))');

        return view('Admin.patients.create', compact('Wards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientsRequest $request)
    {
        try {
            DB::beginTransaction();

            if (isset($request->isIsolted) && $request->isIsolted == 1)
                $request->request->add(['isIsolted' => 1]);
            else
                $request->request->add(['isIsolted' => 0]);

                $request->request->add(['admitted' => now()]);
                $request->request->add(['discharged' => null]);
                
                $room = Room::find($request->room);
              //  return $room ;
                if($request->gender =="male" && $room->type_id =="free" ){
                    $room->type_id = 'blue';
                    $room->save();
                }else if($request->gender =="female" && $room->type_id =="free" ){
                    $room->type_id = 'red';
                    $room->save();
                }



             Patient::create($request->except('_token',"room"));

                DB::commit();
                return redirect()->route('Patients.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('patients.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patinet  $patinet
     * @return \Illuminate\Http\Response
     */
    public function show(PatientsRequest $patinet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patinet  $patinet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient =Patient::find($id);
        return view('Admin.patients.edit', compact('patient'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patinet  $patinet
     * @return \Illuminate\Http\Response
     */
    public function update(PatientsRequest $request, $id)
    {
        try {

            DB::beginTransaction();
            $Patient = Patient::find($id);
            if (isset($request->discharged) && $request->discharged == 1){
                $request->request->add(['discharged' => Now() ]);

                //free room if count bed patient ==1
                $room_id = Room::find($Patient->bed->room_id);
                $rooms = DB::select('select b.id from beds b WHERE  b.room_id ='.$room_id->id .' AND b.id IN(SELECT p.bed_id from patients p where p.bed_id = b.id OR p.discharged = NULL OR p.isIsolted =1)');
                if(count($rooms) == 1){
                    $room_id->type_id = 'free';
                    $room_id->save();
                }
            }

           $Patient->update($request->all());


            DB::commit();
            return redirect()->route('Patients.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Patients.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patinet  $patinet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Patient = Patient::find($id);
        if (!$Patient)
            return redirect()->route('Patients.index')->with(['error' => 'هذا الماركة غير موجود ']);
             foreach ($Patient->ChangesBed as $ChangesBed_Patient) {
                $ChangesBed_Patient->delete();
             }
        $Patient->delete();
        return redirect()->route('Patients.index')->with(['success' => 'تم الحذف بنجاح']);
    }






    //Start Ajax 



    public function getrooms(Request $request)
    {
       // return  $request;
     //   $this->validate( $request, [ $request->id => 'required|exists:wards,id' ] );
     $gender1 =  ($request->gender == "male")?"red":"blue";

     if($request->gender == "male" && $request->isIsolted == 1){
        $rooms = DB::select('select r.id , r.name  from rooms r where r.ward_id ='.request('id') . ' And r.type_id = "free" And r.id  Not 
        in(select b.room_id from beds b WHERE b.room_id = r.id And
         b.id IN(SELECT p.bed_id from patients p where p.bed_id = b.id AND p.discharged != NULL
         AND p.discharged != "0000-00-00 00:00:00"
        OR p.isIsolted =1
        ))');
     }
    //  $request->gender == "male" &&
     else  if( $request->isIsolted == 0 ){
            $rooms = DB::select('select r.id , r.name  from rooms r where r.ward_id ='.request('id') . ' And r.type_id != "'. $gender1 .'" And r.id  Not 
            in(select b.room_id from beds b WHERE b.room_id = r.id And
             b.id IN(SELECT p.bed_id from patients p where p.bed_id = b.id AND p.discharged != NULL
             AND p.discharged != "0000-00-00 00:00:00"
            OR p.isIsolted =1
            ))');
        }
        //   return  $rooms;
        $html = '<option value=""></option>';
      foreach ($rooms as $room) {
        $html .= '<option value="'.$room->id.'">'.$room->name.'</option>';
    }
    return response()->json(['html' => $html]);
    }

    public function getbeds(Request $request)
    {
        // $beds = Bed::get();
        $beds = DB::select('select b.id , b.name  from beds b where b.room_id ='.request('id') . '  And b.id  Not 
            in(SELECT p.bed_id from patients p where  p.bed_id = b.id AND ( p.discharged is NULL
            OR p.discharged = "0000-00-00 00:00:00")
           )');
        //   p.bed_id = b.id AND 
        $html = '<option value=""></option>';
        foreach ($beds as $bed) {
          $html .= '<option value="'.$bed->id.'">'.$bed->name.'</option>';
      }
      return response()->json(['html' => $html]);
    }
}
