<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\customer;
use Hash;
use Illuminate\Support\Facades\View;
use App\providers\AppServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginOutController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function postLogin(Request $request)
    {

        $this->validate($request,
        [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'


        ],
        [
            'email.required' =>'Vui lòng nhập mail',
            'email.email'=>'Email không đúng định dạng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự',
            'password.max'=>'Mật khẩu không quá 20 ký tự'
        ]);

        $data = customer::where('deleted_at', null)->get();
        $email = $request->email;
        $password =$request->password;

            $a =0;
        foreach ($data as $data){

            if($data->cus_email == $email && Hash::check($password, $data->password) ){

                // $request->session()->put('flags', 'success');
                // $request->session()->put('message', 'Đăng nhập thành công');
                $request->session()->put('name',$data['cus_name']);
                $request->session()->put('cus_email',$data['cus_email']);
                $request->session()->put('cus_id',$data['cus_id']);
                $a = 1;
                // ->with(['flags'=>'success','message'=>'Đăng nhập thành công'])
            }
        }

        if($a ==1){
            return redirect()->route('home');
        }
        else{
            $request->session()->flash('flags', 'danger');

            $request->session()->flash('message', 'Đăng nhập không thành công');
            return redirect()->route('index.dangnhap');
        }

            // $request->session()->put('flags', 'danger');
            // $request->session()->put('message', 'Đăng nhập không thành công');

            // return redirect()->back();




    }
    public function logout(request $request)
    {
        $request->session()->flush();
        return redirect()->route('home');
    }
    // tao tai khoản
    public function register()
    {
        return view('register');
    }

    public function postRegister(request $request) {

        $this->validate(
            $request,
            [
                'email' => 'required|email|unique:customers,cus_email',
                'password' => 'required|min:6|max:20',
                'name' => 'required',
                're_password' => 'required|same:password'
            ],
            [
                'email.required' => 'Vui lòng nhập mail',
                'email.email' => 'Nhập đúng định dạng mail',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu',
                're_password.same' => 'Mật khẩu không giống nhau',
            ]
        );
        $cus = new customer;
        $cus->cus_email = $request->email;
        $cus->password = Hash::make($request->password);
        $cus->cus_name = $request->name;
        $cus->cus_addres = $request->addres;
        $cus->cus_phone = $request->phone;
        $cus->save();

        $abc = DB::table('customers')->where([['cus_email',$request->email],['deleted_at',null]])->first();
        $request->session()->put('name',$request->name);
        $request->session()->put('cus_id',$abc->cus_id);
        $request->session()->put('cus_email',$abc->cus_email);

        return redirect()->route('home');

    }
}
