<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

class LoginController extends Controller
{

    public function login()
    {
        return view('Admin.Auth.login');
    }

    public function postLogin(AdminLoginRequest $request)
    {

        //validation

        //check , store , update

        $remember_token = $request->has('remember_token') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("Password") , 'type_id' => $request->input("type_id")], $remember_token)) {
                                        // 00:00:00            14:00:00
            if(!(auth('admin')->user()->shift->start_time <  date('H:i:s') && auth('admin')->user()->shift->end_time >  date('H:i:s'))){
                                // 23:59:59
                 $gaurd = $this->getGaurd();
                 $gaurd->logout();

                 return redirect()->route('admin.login')->with(['error' =>  'ليس معادك الان للدخول']);
            }

            return redirect()->route('Admin');
        }
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }

    public function logout()
    {

        $gaurd = $this->getGaurd();
        $gaurd->logout();

        return redirect()->route('admin.login');
    }

    private function getGaurd()
    {
        return auth('admin');
    }
}
