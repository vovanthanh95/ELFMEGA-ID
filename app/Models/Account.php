<?php

namespace App\Models;

use App\Mail\ForgotPassEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        'email',
        'phone',
        'money',
        'status',
        'createtime',
        'createip',
    ];

    protected $hidden = [];

    public function login($username, $password)
    {
        $info = [];
        $user_bcrypt = Account::where('username', $username)
            ->first();
        if ($user_bcrypt != null && Hash::check($password, $user_bcrypt->password)) {
            if ($user_bcrypt->status != 0) {
                $info['msg'] = trans('message.alertuserisblock');
                $info['type'] = 'error';
                return $info;
            }
            Auth::guard('client')->login($user_bcrypt);
        } else {
            $info['msg'] = trans('message.alertuserorpassnottrue');
            $info['type'] = 'error';
            return $info;
        }
    }

    public function createAccount($username, $password, $ip, $email = "", $phone = "")
    {
        $info = [];
        $this->username = $username;
        $this->password = Hash::make($password);
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
        $this->password = Hash::make($password);
        $this->password2 = $this->encryptSecPwd($password);
        $this->money = '0';
        $this->status = '0';
        $this->createtime = date("Y-m-d H:i:s");
        $this->createip = $ip;
        $user = Account::where(['username' => $username])->first();
        if ($user) {
            $info['msg'] = 'Tài khoản đã được sử dụng';
            $info['code'] = '1';
        } else {
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

    public function updateEmail($email, $ip)
    {
        $info = [];
        $history = new HistoryLog();
        $user = Auth::guard('client')->user()->username;
        $userchange = Account::where(['username' => $user])->first();
        if ($userchange) {
            $userchange->email = $email;
            $user = Auth::guard('client')->user()->username;
            if ($userchange->save() && $history->createHistory($user, trans('message.Textupdateemail'), $email)) {
                $info['msg'] = trans('message.alertupdateemailsuccess');
                $info['type'] = 'success';
                return $info;
            }
        } else {
            $info['msg'] = trans('message.alertemailnottrue');
            $info['type'] = 'error';
            return $info;
        }
    }

    public function updatePhone($phone, $ip)
    {
        $info = [];
        $history = new HistoryLog();
        $user = Auth::guard('client')->user()->username;
        $userchange = Account::where(['username' => $user])->first();
        if ($userchange) {
            $userchange->phone = $phone;
            $user = Auth::guard('client')->user()->username;
            if ($userchange->save() && $history->createHistory($user, trans('message.Textupdatephone'), $phone)) {
                $info['msg'] = trans('message.alertupdatephonesuccess');
                $info['type'] = 'success';
                return $info;
            }
        } else {
            $info['msg'] = trans('message.alertphonenottrue');
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
            if ($userchange->save() && $history->createHistory($user, "ChangePhone", $phone)) {
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
        if ($userchange && Hash::check($password, $userchange->password)) {
            $userchange->password = Hash::make($newpassword);
            $userchange->password2 = $this->encryptSecPwd($newpassword);
            $history = new HistoryLog();
            $user = Auth::guard('client')->user()->username;
            if ($userchange->save() && $history->createHistory($user, "ChangePass", $password)) {
                $info['msg'] = trans('message.alertchangepasssuccess');
                $info['type'] = 'success';
                return $info;
            }
        } else {
            $info['msg'] = trans('message.alertpassnottrue');
            $info['type'] = 'error';
            return $info;
        }
    }

    public function forgotPass($username, $email, $ip)
    {
        $info = [];
        $user = Account::where('username', $username)->first();
        //dd($user);
        if ($user != null) {
            if ($user->email == "") {
                $info['msg'] = 'Tài khoản chưa cập nhật email. Vui lòng liên hệ Fanpage để được hỗ trợ';
                $info['type'] = 'error';
                return $info;
            }
            if ($user->email != $email) {
                $info['msg'] = 'Tài khoản hoặc Email không đúng';
                $info['type'] = 'error';
                return $info;
            }
            $newpass = random_int(00000000, 99999999);
            $user->password = Hash::make($newpass);
            $user->password2 = $this->encryptSecPwd(strval($newpass));
            $history = new HistoryLog();
            if ($user->save() && $history->createHistory($username, "ForgotPass", $ip)) {
                Auth::guard('client')->login($user);
                $info['msg'] = trans('message.alertcheckpassinemail');
                $info['type'] = 'success';
                $details = [
                    'username' => $username,
                    'newpass' => $newpass,
                ];
                Mail::to($email)->send(new ForgotPassEmail($details));
                return $info;
            } else {
                $info['msg'] = trans('message.alertpleasetryagain');
                $info['type'] = 'error';
                return $info;
            }
        } else {
            $info['msg'] = trans('message.alertuseroremailnottrue');
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
            return false;
        }
    }

    public function getUserByUserName2($username)
    {
        $data = Account::where('username', $username)->first();
        return $data;
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
    public function setCoin($username, $money)
    {
        $data = Account::where('username', $username)->first();
        if ($data != null) {
            $data->money = $money;
            $data->save();
            return true;
        } else {
            return false;
        }
    }
    public function setMoneySumMoney($username, $money)
    {
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

    public function apiRegister($username, $password, $platform, $ip, $countryname, $countrycode)
    {
        $data = $this->getUserByUserName($username);
        $info = [];
        if ($data != null) {
            $info['msg'] = trans('message.alertusernameisexist');
            $info['type'] = 'error';
            return $info;
        } else {
            try {
                $account = new Account();
                $account->username = $username;
                $account->password = Hash::make($password);
                $account->password2 = $this->encryptSecPwd($password);
                $account->access_token = Str::random(40);
                $account->refresh_token = Str::random(40);
                $account->os_register = $platform;
                $account->os = $platform;
                $account->createtime = date("Y-m-d H:i:s");
                $account->createip = $ip;
                $account->countryname = $countryname;
                $account->countrycode = $countrycode;
                $account->expires = date('Y-m-d H:i:s', strtotime('+2 hour', strtotime(date("Y-m-d H:i:s"))));
                $account->save();
                Auth::guard('client')->login($account);
                return $info;
            } catch (\Throwable $th) {
                $info['msg'] = trans('message.alertregistererror');
                $info['type'] = 'error';
                return $info;
            }
        }
    }

    public function apiLogin($username, $password, $platform)
    {
        $info = [];
        $user_bcrypt = Account::where('username', $username)
            ->first();
        if ($user_bcrypt != null && Hash::check($password, $user_bcrypt->password)) {
            if ($user_bcrypt->status != 0) {
                $info['msg'] = trans('message.alertuserisblock');
                $info['type'] = 'error';
                return $info;
            }
            try {
                if ($user_bcrypt->expires < date("Y-m-d H:i:s") | $user_bcrypt->os != $platform) {
                    $user_bcrypt->access_token = Str::random(40);
                    $user_bcrypt->refresh_token = Str::random(40);
                    $user_bcrypt->expires = date('Y-m-d H:i:s', strtotime('+2 hour', strtotime(date("Y-m-d H:i:s"))));
                    $user_bcrypt->os = $platform;
                    $user_bcrypt->save();
                    Auth::guard('client')->login($user_bcrypt);
                } else {
                    Auth::guard('client')->login($user_bcrypt);
                }
            } catch (\Throwable $th) {
                $info['msg'] = trans('message.alertuserorpassnottrue');
                $info['type'] = 'error';
                return $info;
            }
        } else {
            $info['msg'] = trans('message.alertuserorpassnottrue');
            $info['type'] = 'error';
            return $info;
        }
    }

    public function addAccumulat($username, $amount)
    {
        try {
            $data = Account::where('username', $username)->first();
            $data->accumulat = $data->accumulat + $amount;
            $data->save();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public function getAccumulat($username)
    {
        try {
            $data = Account::where('username', $username)->first();
            return $data->accumulat;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateAccumulat($username, $money)
    {
        try {
            $data = Account::where('username', $username)->first();
            if ($data != null) {
                $data->accumulat = $data->accumulat - $money;
                $data->save();
                return true;
            }
            return false;
        } catch (\Throwable $th) {
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
