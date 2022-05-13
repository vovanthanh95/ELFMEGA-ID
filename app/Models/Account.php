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
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'username',
        'password',
        'password3',
        'email',
        'phone',
        'money',
        'status',
        'createtime',
        'createip',
    ];

    protected $hidden = [
        'password3',
    ];

    public function login($username, $password)
    {
        $info = [];
        $user_bcrypt = Account::where('username', $username)
            ->first();
        $user_md5 = Account::where('username', $username)
            ->where('password', md5($password))
            ->first();
        if ($user_bcrypt != null && Hash::check($password, $user_bcrypt->password3)) {
            if ($user_bcrypt->status != 0) {
                $info['msg'] = 'tài khoản bị khóa';
                return $info;
            }
            Auth::guard('client')->login($user_bcrypt);
        } elseif ($user_md5 != null) {
            if ($user_md5->status != 0) {
                $info['msg'] = 'tài khoản bị khóa';
                return $info;
            }
            Auth::guard('client')->login($user_md5);
        } else {
            $info['msg'] = 'tên hoặc mật khẩu chưa đúng';
            return $info;
        }
    }

    public function createAccount($username, $password ,$email , $phone, $ip){
        $this->username = $username;
        $this->password3 = Hash::make($password);
        $this->password2 = $this->encryptSecPwd($password);
        $this->email = $email;
        $this->phone = $phone;
        $this->money = '0';
        $this->status = '0';
        $this->createtime = date("Y-m-d H:i:s");
        $this->createip = $ip;
        $this->save();
    }
//-----------------------------------------------------------------------------------------------------------//
    public function encryptSecPwd($string, $key = "SecPwd") {
        $en = $this->rc4($key, $string);
        return base64_encode($en);
    }
    public function rc4($key, $str) {
        $s = array();
        for ($i = 0; $i < 256; $i++) {
            $s[$i] = $i;
        }
        $j = 0;
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
        }
        $i = 0;
        $j = 0;
        $res = '';
        for ($y = 0; $y < strlen($str); $y++) {
            $i = ($i + 1) % 256;
            $j = ($j + $s[$i]) % 256;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
            $res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
        }
        return $res;
    }
}
