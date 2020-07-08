<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use DB;

class comment extends Model
{
    protected $primaryKey = 'comm_id';
    // public function commindex(){
    //     $listComm = DB::table('comments')->join('comments', 'cus_id', '=', 'customers.cus_id')->orderBy('cus_id')->limit(3)->get();
    //     return $listComm;
    // }
}
