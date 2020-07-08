<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\customer;
use App\category;
use App\User;
use validate;
use Hash;
use Illuminate\Support\Facades\View;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {

        $email = $request->email;
        $password = $request->password;

        // $arr = DB::table('users')->where('email', $email)->where('password', $password)->count();
        // if($arr > 0){
        //     // co ton tai tai khoan
        //     // đẩy thẳng qua admin.dashboard chưa check qua auth
        //     return view('layouts_back_end.dashboard');

        // }
        if(Auth::attempt(['email' => $email, 'password' => $password]) ){

            return redirect()->route('admin.Dashboard');
        }
        // return redirect()->route('login')->with('errmsg', 'Sai thông tin tài khoản/mật khẩu');

        // else{
        //     // khong ton tai
        dd('aaaa');
            $eror = '<div class=" alert alert-danger">Đăng nhập thất bại </div>';
            return view('auth.login',compact('eror'));
        // }

    }
    public function logout()
    {
        // return redirect()->action('FrontendController@welcome');
    }
    // tao tai khoản
    public function register()
    {
        // return view('register');
    }

    public function postRegister(request $request)
    {
        //  valid hay validate hổng biết sai ntn

        // $this->validate(
        //     $request,
        //     [
        //         'email' => 'required|email|unique:customer,cus_email',
        //         'password' => 'required|min:6|max:20',
        //         'name' => 'required',
        //         're_password' => 'required|same:password'
        //     ],
        //     [
        //         'email.required' => 'Vui lòng nhập mail',
        //         'email.email' => 'Nhập đúng định dạng mail',
        //         'email.unique' => 'Email đã tồn tại',
        //         'password.required' => 'Vui lòng nhập mật khẩu',
        //         're_password.same' => 'Mật khẩu không giống nhau',
        //     ]
        // );
        // $cus = new customer();
        // $cus->cus_email = $request->email;
        // $cus->password = Hash::make($request->password);
        // $cus->cus_name = $request->name;
        // $cus->cus_addres = $request->addres;
        // $cus->cus_phone = $request->phone;
        // $cus->save();
        // return redirect()->back()->with('thanhcong', 'Tạo tài khoản thành công');
    }
}
