<?php

namespace App\Http\Controllers;

use App\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard1Controller extends Controller
{
    public function index(){
        $count_cate = DB::table('categories')->count();
        $count_pr = DB::table('products')->count();
        $count_od_ok = DB::table('orders')->where('status',2)->count();
        $count_cus = DB::table('customers')->count();
        $count_od = DB::table('orders')->count();

        // sử lý đơn hàng mới nhất
        // $datas = DB::table('orders')->where('deleted_at', null)->where('status',0)->orderBy('od_id','desc')->limit(5);
        $datas = DB::table('orders')->where('deleted_at',null)->orderBy('od_id','desc')->paginate(4);

        return view('layouts_back_end.dashboard' , compact('count_cate','count_pr','count_cus','count_od','count_od_ok')) ->with('datas',$datas);
    }
}
