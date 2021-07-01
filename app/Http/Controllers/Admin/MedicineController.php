<?php

namespace App\Http\Controllers\Admin;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicinesRequest;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          //permissions
          typePage("manger");

        $medicines = Medicine::paginate(PAGINATION_COUNT);
        return view('Admin.medicines.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          //permissions
          typePage("manger");

        return view('Admin.medicines.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicinesRequest $request)
    {
        //return $request;
        try {
            DB::beginTransaction();

            Medicine::create($request->except('_token'));

            logss("Add Row in Medicine");

                DB::commit();
                return redirect()->route('Medicines.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Medicines.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function edit($id)
    {
          //permissions
          typePage("manger");
          
        $medicine =Medicine::find($id);
        return view('Admin.medicines.edit', compact('medicine'));
    }


    public function update(MedicinesRequest $request,$id)
    {
        //return $request;
        try {

            DB::beginTransaction();
            $Patient = Medicine::find($id);


           $Patient->update($request->all());
           logss("Edit Row in Medicine");
            DB::commit();
            return redirect()->route('Medicines.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Medicines.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
        $Medicine = Medicine::find($id);
        if (!$Medicine)
            return redirect()->route('Medicines.index')->with(['error' => 'هذا الماركة غير موجود ']);
            logss("delete Row in Medicine");
        $Medicine->delete();
        return redirect()->route('Medicines.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
