<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Models\Admin;
use App\Models\Patient;
use App\Models\Surgery;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
         $Doctorcount = Admin::Doctor()->count();
         $Nursecount = Admin::Nurse()->count();
         $patientCount = Patient::count();
        // $ContactUSCount = ContactUS::count();
        // $DoctorCount = Doctor::count();
        $Surgeries = Surgery::get();

        //return  $DoctorSchedules ;
        foreach ($Surgeries as $Surgery) {

            $events[] = [
                'title' => $Surgery->patient->name . " To Docotr: " .$Surgery->doctor->name   ,
                'start' => $Surgery->startTime,
                'end' => $Surgery->endTime,
                'url'   => route('Surgeries.show', $Surgery->id),
                // "color"=> 'red',
                // "textColor"=> 'white',

            ];
        }
       // return today();
        return view('Admin.index',compact('Nursecount','Doctorcount','patientCount',"events"));
    }


    public function profile()
    {
        $admin = auth('admin')->user();
        // Auth()->guard('admin')->user()
        return view('Admin.profile.index', compact('admin'));
    }


    public function updateprofile(AdminProfileRequest $request, $id)
    {

        $admin = Admin::findOrfail($id);
        // return $request;
        $admin->name = $request->name;
        $admin->email = $request->email;
        if (isset($request['password']) && $request['password'] != '') {
            $admin->password = bcrypt($request['password']);
        }
        $admin->save();

        // DB::commit();
        return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
    }
}
