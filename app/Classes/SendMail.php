<?php

namespace App\Classes;

class SendMail
{
    public function addSendMail($itemarray, $uid, $sid, $title = "GM", $content = "GM")
    {
        $url = "http://127.0.0.1:5$sid/hgame/background_api";
        $data = array(
            "action" => 'gvmmail',
            "playerid" => $uid,
            "gvmkey" => "vemA6CTMWQKitr3JKbt9HZ1uh5sHKJRD",
            "mail" => array(
                "sender" => "Jessie",
                "title" => $title,
                "content" => $content,
                "reward" => $itemarray,
            )
        );

        $data_string = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            print_r(curl_error($ch));
        }
        curl_close($ch);

        return $result['code'];
    }
}
