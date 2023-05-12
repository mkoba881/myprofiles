<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');

    // ★テーブル名を指定kクラスはProfilesのクラスはひとつなのでなぜ指定必要か確認。
    protected $table = 'myprofiles.profiles_histories';

    public static $rules = array(
        'profiles_id' => 'required',
        'edited_at' => 'required',
    );
}
