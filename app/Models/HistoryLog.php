<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HistoryLog extends Authenticatable
{
    use HasFactory;
    protected $table = "history_log";
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'type',
        'username',
        'content',
        'time',
        'status',
        'note',
    ];

    public function getHistoryLog($username)
    {
        $hdBeginDate = strtotime(request()->hdBeginDate);
        $hdEndDate = strtotime(request()->hdEndDate);
        $table    = "";
        $search = "";
        if (isset(request()->hdBeginDate) and request()->hdBeginDate != "") {
            $search .= " AND time >= '" . date("Y-m-d 00:00:00", $hdBeginDate) . "'";
        }
        if (isset(request()->hdEndDate) and request()->hdEndDate != "") {
            $search .= " AND time <= '" . date("Y-m-d 23:59:59", $hdEndDate) . "'";
        }

        $page = trim(request()->page);
        $json = array();
        if ($page < 1){ $page = 1;}
        $row_count = 5;
        $offset = ($page - 1) *  $row_count;

        $totalitem = 0;
        $dem = 1 + ($page * $row_count) - $row_count;
        $d_count = HistoryLog::where('username', $username)
            ->where('status', 1)
            ->where('type', '<>', 'Login')->get()->count();
        $result =  HistoryLog::where('username', $username)
            ->where('status', 1)
            ->where('type', '<>', 'Login')
            ->orderby('time', 'DESC')
            ->offset($offset)
            ->limit($row_count)
            ->get();
        if ($result->count() > 0) {
            $json['table'] = '<ul class="tbl-row-group">';
                foreach($result as $key => $value){
                $array = explode("|", $value['content']);
                $status = "";
                if ($value['status'] == 1) {
                    $status = '<font color="#3079ed">' . __('message.success') . '</font>';
                } else if ($value['status'] == 2) {
                    $status = '<font color="#0515f5">' . __('message.invalidcardcode') . '</font>';
                } else if ($value['status'] == 3) {
                    $status = '<font color="#0515f5">' . __('message.errorofloadingcardvalue') . '</font>';
                } else if ($value['status'] == 4) {
                    $status = '<font color="#0515f5">' . __('message.theserverisundermaintenance') . '</font>';
                } else if ($value['status'] == 5) {
                    $status = '<font color="#0515f5">' . __('message.cardused') . '</font>';
                } else if ($value['status'] == 0) {
                    $status = '<font color="blue">' . __('message.waitingforprogressing') . '</font>';
                } else {
                    $status = '<font color="#0515f5">' . __('message.theserverisempty') . '</font>';
                }
                $content = "";
                $type = "";
                switch ($value['type']) {
                    case "PrepaidCard":
                        $type = __('message.topup');
                        $content = __('message.historymsg1') . " <span style='color:#0515f5'>" . $array[0] . "</span> " . __('message.historymsg2') . " <span style='color:red'>" . number_format($array[2]) . "</span> " . __('message.historymsg3') . " <span style='color:red'>" . number_format($array[3]) . "</span> " . config('custom.namemoney');
                        break;
                    case "MOMO":
                        $type =  __('message.topup');
                        $content = __('message.historymsg1') . " <span style='color:#0515f5'>" . $array[0] . "</span> " . __('message.historymsg2') . " <span style='color:red'>" . number_format($array[2]) . "</span> " . $__('message.historymsg3'). " <span style='color:red'>" . number_format($array[3]) . "</span> " . config('custom.namemoney');
                        break;
                    case "ATM":
                        $type =  __('message.topup');
                        $content = __('message.historymsg1') . " <span style='color:#0515f5'>" . $array[0] . "</span> " . __('message.historymsg2') . " <span style='color:red'>" . number_format($array[2]) . "</span> " . __('message.historymsg3') . " <span style='color:red'>" . number_format($array[3]) . "</span> " . config('custom.namemoney');
                        break;
                    case "Recharge":
                        $type =  __('message.recharge');
                        $content = __('message.historymsg4') . " <span style='color:#0515f5'>" . $array[1] . "</span> " . __('message.historymsg5') . " <span style='color:red'>" . number_format($array[2]) . "</span> " . config('custom.namemoney');
                        break;
                    case "ChangePass":
                        $type =  __('message.changepass');
                        $content = __('message.executedsuccessatip') . " " . $array[0];
                        break;
                    case "ChangeEmail":
                        $type =  __('message.changeemail');
                        $content =  __('message.executedsuccessatip') . " " . $array[0];
                        break;
                    case "ChangePhone":
                        $type =  __('message.changephone');
                        $content =  __('message.executedsuccessatip') . " " . $array[0];
                        break;
                    case "ForgotPass":
                        $type = __('message.forgotpass');
                        $content = __('message.executedsuccessatip') . " " . $array[0];
                        break;
                    case "Login":
                        $type = __('message.login');
                        $content = __('message.executedsuccessatip') . " " . $array[0];
                        break;
                    case "GiftCode":
                        $type = __('message.giftcode');
                        $content = __('message.receivedsuccessfullygiftcode') . " <span style='color:#f13d56'>" . $array[0] . "</span>";
                        break;
                    case "RechargeGift":
                        $type = __('message.event');
                        $content = __('message.receivedsuccessfullyevent') . " " . $array[0];
                        break;
                    case "TranferDiamon":
                        $type = __('message.transferdiamon');
                        $content = __('message.characters') . " " . $array[0] . " " . __('message.historymsg3') . " " . $array[4] . " " . __('message.diamond');
                        break;
                    case "BuyProduct":
                        $type = __('message.buypackages');
                        $content = __('message.successfulpurchaseofthepackage') . " <span style='color:#f13d56'>" . number_format($array[2]) . "</span> " . config('custom.namemoney');
                        break;
                    case "TMT":
                        $type = __('message.topup');
                        $content = __('message.historymsg1') . " " . $array[0] . " " . __('message.historymsg2') . " " . number_format($array[2]) . " " . __('message.historymsg3') . " " . number_format($array[3]) . " " . config('custom.namemoney');
                        break;
                    default:
                        $type = $value['type'];
                        $content = "";
                        break;
                }
                $table .= '
        	<div class="list-data-content txn row">
        		<div class="col-4 order-left-content">
        			<p><span class="blue">' . $type . '</span></p>
        			<p>' . date('H:i d/m/y', strtotime($value['time'])) . '</p>
        		</div>
        		<div class="col-8">
        			<p class="text-right "><span class="blue">' . $content . '</span></p>
        		</div>
        		<div class="clearfix"></div>
        	</div>
        ';
                if (!$totalitem)
                    $totalitem = $d_count;
                $dem++;
            }
            $totalpage = ceil($totalitem / $row_count);
            $json['totalpage'] = ceil($totalitem / $row_count);
            $json['totalitem'] = $totalitem;
        }
        $json['table'] .= '</ul>';
        $json['table'] = $table;
        return $json;
    }

    public function createHistory($username, $type, $content, $status = 1, $note = ""){
        $this->username = $username;
        $this->type = $type;
        $this->content = $content;
        $this->status = $status;
        $this->time = date("Y-m-d H:i:s");
        $this->note = $note;
        if($this->save()){
            return true;
        }else{
            return false;
        };
    }

    public function updateHistoryLogTopUp($status, $note){
        $data = HistoryLog::where('note', $note)->first();
        if($data != null){
            $data->status = $status;
            $data->save();
        }
    }
}
