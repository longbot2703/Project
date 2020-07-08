<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';
    protected $fillable = ['pr_id','cat_id','pr_name','pr_image','pr_prcie','pr_description','pr_quantity','pr_title'];
    public function products(){
    	return $this->belongsTo('App\category', 'cat_id','cat_id');
    }

    //Không xóa dòng này
    protected $primaryKey = 'pr_id';
}
