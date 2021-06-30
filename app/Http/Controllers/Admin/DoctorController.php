<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorImageRequest;
use App\Http\Requests\DoctorSpecialPriceRequest;
use App\Http\Requests\DoctorRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\ImageDoctor;
use App\Models\Shift;
use App\Models\Tag;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{

    public function index()
    {
        //permissions
        typePage("manger");

        $doctors = Admin::Doctor()->paginate(PAGINATION_COUNT);
        return view('Admin.doctors.index', compact('doctors'));
    }


    public function create()
    {
                //permissions
                typePage("manger");

        // where('name','!=', null)->
        $Shifts = Shift::get();
        // return $categories ;
        return view('Admin.doctors.create', compact('Shifts'));
    }

    public function store(DoctorRequest $request)
    {
       try {

            DB::beginTransaction();

                $request->request->add(['type_id' => 'doctor']);
                $request->request->add(['password' => bcrypt($request->password)]);
            //    return $request->all();


            // return $request->except('_token','type');
            $doctor =  Admin::create($request->except('_token'));

        //start logs
        logss("store Row in Doctor");
        //End Logs

            DB::commit();
            return redirect()->route('Doctors.index')->with(['success' => ' تم ألاضافة بنجاح']);
       } catch (\Exception $ex) {
           DB::rollback();
           return redirect()->route('Doctors.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
       }
    }


    public function edit($id)
    {
                //permissions
                typePage("manger");
        
        $doctor = Admin::Doctor()->findOrFail($id);
        $Shifts = Shift::get();

        //   return date_format($Doctors->special_price_start ,'Y-m-d') ;
        return view('Admin.doctors.edit', compact('Shifts', "doctor"));
    }


    public function update(DoctorRequest $request, $id)
    {
        try {
            // return $request;
            DB::beginTransaction();
            $doctor = Admin::Doctor()->find($id);

            if(isset($request['password']) && $request->password !='')
                $doctor->password = bcrypt($request['password']);

            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->shift_id = $request->shift_id;
            $doctor->save();
        //start logs
        logss("update Row in Doctor");
        //End Logs
            DB::commit();
            return redirect()->route('Doctors.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Doctors.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }





    public function destroy($id)
    {
        $Doctor = Admin::Doctor()->find($id);
        if (!$Doctor)
        return redirect()->route('Doctors.index')->with(['error' => 'هذا الماركة غير موجود ']);
        $Doctor->delete();
                //start logs
                logss("delete Row in Doctor");
                //End Logs
        return redirect()->route('Doctors.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
