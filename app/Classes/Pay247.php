<?php
namespace App\Classes;
class Pay247{
    public function tichHop247($APIKey, $Network, $CardCode, $CardSeri, $CardValue, $URLCallback, $TrxID) {
        global $config;
        $curl = curl_init('http://tichhop247.com/API/NapThe?APIKey=' .$APIKey. '&Network=' .$Network. '&CardCode=' .$CardCode. '&CardSeri=' .$CardSeri. '&CardValue=' .$CardValue. '&URLCallback=' .$URLCallback. '&TrxID=' .$TrxID);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $curl_content = curl_exec($curl);
        if($curl_content === false) {
            die(curl_errno($curl) . ':' . curl_error($curl));
        }
        curl_close($curl);
        return $curl_content;
    }
}
