<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['cat_id','cat_name'];
    protected $primaryKey = 'cat_id';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
