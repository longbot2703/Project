<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class customer extends Model
{
    protected $primaryKey = 'cus_id';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
