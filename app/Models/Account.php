<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Account extends Authenticatable
{
    use HasFactory;

    protected $table = "account";
    public $timestamps = false;
    protected $primaryKey = 'username';

    protected $fillable = [
        'username',
        'password',
        'password3',
    ];

    protected $hidden = [
        'password3',
    ];

    public function login($username, $password)
    {
        $user_bcrypt = Account::where('username', $username)
            ->first();
        $user_md5 = Account::where('username', $username)
            ->where('password', md5($password))
            ->first();
        if ($user_bcrypt != null && Hash::check($password, $user_bcrypt->password3)) {
            Auth::guard('client')->login($user_bcrypt);
        } elseif ($user_md5 != null) {
            Auth::guard('client')->login($user_md5);
        }
    }
}
