<?php

namespace App\Models;

use App\Mail\ForgotPassEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Account extends Authenticatable
{
    use HasFactory;

    protected $table = "account";
    public $timestamps = false;
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
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
                $info['msg'] = 'Tài khoản bị khóa';
                $info['type'] = 'error';
                return $info;
            }
            Auth::guard('client')->login($user_bcrypt);
        } elseif ($user_md5 != null) {
            if ($user_md5->status != 0) {
                $info['msg'] = 'Tài khoản bị khóa';
                $info['type'] = 'error';
                return $info;
            }
            $user_md5->password3 = Hash::make($password);
            $user_md5->save();
            Auth::guard('client')->login($user_md5);
        } else {
            $info['msg'] = 'Tên hoặc mật khẩu chưa đúng';
            $info['type'] = 'error';
            return $info;
        }
    }

    public function createAccount($username, $password, $ip, $email = "", $phone = "")
    {
        $info = [];
        $this->username = $username;
        $this->password3 = Hash::make($password);
        $this->password2 = $this->encryptSecPwd($password);
        $this->email = $email;
        $this->phone = $phone;
        $this->money = '0';
        $this->status = '0';
        $this->createtime = date("Y-m-d H:i:s");
        $this->createip = $ip;
        if ($this->save()) {
            $info['msg'] = 'Đăng kí thành công';
            $info['type'] = 'success';
        } else {
            $info['msg'] = 'Đăng kí thất bại';
            $info['type'] = 'error';
        };
        return $info;
    }

    public function createAccountApp($username, $password, $ip)
    {
        $info = [];
        $this->username = $username;
        $this->password3 = Hash::make($password);
        $this->password2 = $this->encryptSecPwd($password);
        $this->money = '0';
        $this->status = '0';
        $this->createtime = date("Y-m-d H:i:s");
        $this->createip = $ip;
        $user = Account::where(['username' => $username])->first();
        if($user){
            $info['msg'] = 'Tài khoản đã được sử dụng';
            $info['code'] = '1';
        }else{
            if ($this->save()) {
                $info['msg'] = 'Đăng ký tài khoản thành công';
                $info['code'] = '0';
            } else {
                $info['msg'] = 'Lỗi đăng ký tài khoản';
                $info['code'] = '1';
            };
        }

        return $info;
    }

    public function changeEmail($email, $newemail, $ip)
    {
        $info = [];
        $history = new HistoryLog();
        $userchange = Account::where(['email' => $email])->first();
        if ($userchange) {
            $userchange->email = $newemail;
            $user = Auth::guard('client')->user()->username;
            if ($userchange->save() && $history->createHistory($user, "ChangeEmail", $ip)) {
                $info['msg'] = 'Đổi email thành công';
                $info['type'] = 'success';
                return $info;
            }
        } else {
            $info['msg'] = 'Email hoặc số điện thoại không đúng';
            $info['type'] = 'error';
            return $info;
        }
    }

    public function changePhone($phone, $newphone, $ip)
    {
        $info = [];
        $userchange = Account::where(['phone' => $phone])->first();
        if ($userchange) {
            $userchange->phone = $newphone;
            $history = new HistoryLog();
            $user = Auth::guard('client')->user()->username;
            if ($userchange->save() && $history->createHistory($user, "ChangePhone", $ip)) {
                $info['msg'] = 'Đổi số điện thoại thành công';
                $info['type'] = 'success';
                return $info;
            }
        } else {
            $info['msg'] = 'Email hoặc số điện thoại không đúng';
            $info['type'] = 'error';
            return $info;
        }
    }

    public function changePassWord($password, $newpassword, $ip)
    {
        $info = [];
        $userchange = Account::where(['username' => Auth::guard('client')->user()->username])->first();
        if ($userchange && Hash::check($password, $userchange->password3)) {
            $userchange->password3 = Hash::make($newpassword);
            $userchange->password = "";
            $userchange->password2 = $this->encryptSecPwd($newpassword);
            $history = new HistoryLog();
            $user = Auth::guard('client')->user()->username;
            if ($userchange->save() && $history->createHistory($user, "ChangePass", $ip)) {
                $info['msg'] = 'Đổi số mật khẩu thành công';
                $info['type'] = 'success';
                return $info;
            }
        } else {
            $info['msg'] = 'Mật khẩu không đúng';
            $info['type'] = 'error';
            return $info;
        }
    }

    public function forgotPass($username, $email, $ip)
    {
        $info = [];
        $user = Account::where(['username' => $username, 'email' => $email])->first();
        //dd($user);
        if ($user != null) {
            $newpass = random_int(0000000, 9999999);
            $user->password3 = Hash::make($newpass);
            $user->password2 = $this->encryptSecPwd(strval($newpass));
            $history = new HistoryLog();
            if ($user->save() && $history->createHistory($username, "ForgotPass", $ip)) {
                $info['msg'] = 'Hãy kiểm tra password ở email đã đăng ký';
                $info['type'] = 'success';
                $details = [
                    'username' => $username,
                    'newpass' => $newpass,
                ];
                Mail::to($email)->send(new ForgotPassEmail($details));
                return $info;
            } else {
                $info['msg'] = 'Vui lòng thử lại';
                $info['type'] = 'error';
                return $info;
            }
        } else {
            $info['msg'] = 'Tên đăng nhập hoặc email không đúng';
            $info['type'] = 'error';
            return $info;
        }
    }

    public function getUserByUserName($username)
    {
        $data = Account::where('username', $username)->first();
        if ($data != null) {
            return $data->toArray();
        } else {
            return $data;
        }
    }

    public function updateMoneyTopUp($username, $moneynew)
    {
        $data = Account::where('username', $username)->first();
        if ($data != null) {
            $data->money = $moneynew;
            $data->save();
        }
    }
    public function getCoin($username)
    {
        $data = Account::where('username', $username)->first();
        if ($data != null) {
            return $data->toArray()['money'];
        } else {
            return 0;
        }
    }
    public function setCoin($username, $money){
        $data = Account::where('username', $username)->first();
        if ($data != null) {
            $data->money = $money;
            $data->save();
            return true;
        } else {
            return false;
        }
    }
    public function setMoneySumMoney($username, $money){
        $data = Account::where('username', $username)->first();
        if ($data != null) {
            $data->money += $money;
            $data->summoney += $money;
            $data->save();
            return true;
        } else {
            return false;
        }
    }
    //-----------------------------------------------------------------------------------------------------------//
    public function encryptSecPwd($string, $key = "SecPwd")
    {
        $en = $this->rc4($key, $string);
        return base64_encode($en);
    }
    public function rc4($key, $str)
    {
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
