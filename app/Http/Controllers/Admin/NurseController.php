<?php

namespace App\Http\Controllers\Admin;

use App\Models\nurse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\nurseImageRequest;
use App\Http\Requests\nursespecialPriceRequest;
use App\Http\Requests\nurseRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Imagenurse;
use App\Models\Shift;
use App\Models\Tag;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NurseController extends Controller
{

    public function index()
    {
                //permissions
                typePage("manger");
        
        $nurses = Admin::Nurse()->paginate(PAGINATION_COUNT);
        return view('Admin.nurses.index', compact('nurses'));
    }


    public function create()
    {
                //permissions
                typePage("manger");

        // where('name','!=', null)->
        $Shifts = Shift::get();
        // return $categories ;
        return view('Admin.nurses.create', compact('Shifts'));
    }

    public function store(DoctorRequest $request)
    {
       try {

            DB::beginTransaction();

                $request->request->add(['type_id' => 'nurse']);
                $request->request->add(['password' => bcrypt($request->password)]);
            //    return $request->all();


            // return $request->except('_token','type');
            $nurse =  Admin::create($request->except('_token'));
               //start logs
               logss("create Row in Nurse");
               //End Logs
            DB::commit();
            return redirect()->route('Nurses.index')->with(['success' => ' تم ألاضافة بنجاح']);
       } catch (\Exception $ex) {
           DB::rollback();
           return redirect()->route('Nurses.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
       }
    }


    public function edit($id)
    {
                //permissions
                typePage("manger");

        $nurse = Admin::nurse()->findOrFail($id);
        $Shifts = Shift::get();

        //   return date_format($nurses->special_price_start ,'Y-m-d') ;
        return view('Admin.nurses.edit', compact('Shifts', "nurse"));
    }


    public function update(DoctorRequest $request, $id)
    {
        try {
            // return $request;
            DB::beginTransaction();
            $nurse = Admin::nurse()->find($id);

            if(isset($request['password']) && $request->password !='')
                $nurse->password = bcrypt($request['password']);

            $nurse->name = $request->name;
            $nurse->email = $request->email;
            $nurse->shift_id = $request->shift_id;
            $nurse->save();
               //start logs
               logss("updae Row in Nurse");
               //End Logs
            DB::commit();
            return redirect()->route('Nurses.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('nurses.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        $nurse = Admin::Nurse()->find($id);
        if (!$nurse)
        return redirect()->route('Nurses.index')->with(['error' => 'هذا الماركة غير موجود ']);
        $nurse->delete();
               //start logs
               logss("delete Row in Nurse");
               //End Logs
        return redirect()->route('Nurses.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
