<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    public static $rules = array(
        'profile_name' => 'required',
        'introduction' => 'required',
        'career' => 'required',
        'achievement' => 'required',
    );
    
    // Profiles Modelに関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\Models\History');
    }
}
