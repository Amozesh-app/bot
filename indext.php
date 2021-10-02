<?php

error_reporting(0);
ob_start('ob_gzhandler');
date_default_timezone_set("Asia/Tehran");

#------------bomb_Source-----------------#
//https://t.me/My_oj https://t.me/My_oj https://t.me/My_oj
$telegram_ip_ranges = [
['lower' => '149.154.160.0', 'upper' => '149.154.175.255'], 
['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],    
];
$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok=false;
foreach ($telegram_ip_ranges as $telegram_ip_range){
	if(!$ok){
		$lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
		$upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
		if($ip_dec >= $lower_dec and $ip_dec <= $upper_dec){
			$ok=true;
		}
	}
}
if(!$ok){
	exit(header("location: https://myoj.ir"));
}

$token         = "1611764844:AAG9epzhSHNUpnFGj0jbH8oPAtz-dTHSJ20"; # توکن ربات
//توکن ربات در خط بالا
#-----------------------------#
//https://t.me/My_oj https://t.me/My_oj https://t.me/My_oj
$update = json_decode(file_get_contents("php://input"));
if(isset($update->message)){
    $from_id    = $update->message->from->id;
    $chat_id    = $update->message->chat->id;
    $text       = $update->message->text;
    $first_name = $update->message->from->first_name;
    $message_id = $update->message->message_id;
}elseif(isset($update->callback_query)){
    $chat_id    = $update->callback_query->message->chat->id;
    $data       = $update->callback_query->data;
    $query_id   = $update->callback_query->id;
    $message_id = $update->callback_query->message->message_id;
    $from_id    = $update->callback_query->from->id;
    $first_name = $update->callback_query->from->first_name;
}

#-----------------------------#

define('API_KEY', $token);

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//https://t.me/My_oj https://t.me/My_oj https://t.me/My_oj
#-----------------------------#
//https://t.me/My_oj https://t.me/My_oj https://t.me/My_oj
function sendmessage($chat_id,$text,$keyboard = null) {
    bot('sendMessage',[
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => "Markdown",
        'disable_web_page_preview' => true,
        'reply_markup' => $keyboard
    ]);
}

function editmessage($chat_id,$message_id,$text,$keyboard = null) {
    bot('editmessagetext',[
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => $text,
        'parse_mode' => "Markdown",
        'disable_web_page_preview' => true,
        'reply_markup' => $keyboard
    ]);
}

function deletemessage($chat_id,$message_id) {
    bot('deletemessage',[
        'chat_id' => $chat_id,
        'message_id' => $message_id,
    ]);
}


#-----------------------------#

if(!is_dir("data")){
    
    mkdir("data");

}

if(!is_dir("data/$from_id")){
    
    mkdir("data/$from_id");
    file_put_contents("data/$from_id/step.txt", "none");

}

$step = file_get_contents("data/$from_id/step.txt");

#-----------------------------#

$start_key = json_encode(['keyboard' => [
    [['text' => "دریافت برنامه"],['text' => "درباره ما"]],
], 'resize_keyboard' => true]);

$back_key = json_encode(['keyboard' => [
    [['text' => "➡️ بازگشت ⬅️"]],
], 'resize_keyboard' => true]);

#-----------------------------#

if($text == "/start" or $text == "➡️ بازگشت ⬅️"){
    
    sendmessage($from_id, "👋 سلام!\n\n*به ربات برنامه زیباساز خوش آمدید*\n\nطراح و برنامه نویس : صالح جانخانی", $start_key);
    file_put_contents("data/$from_id/step.txt", "none");
    
}

elseif($text == "دریات برنامه"){
    
    sendmessage($from_id, "لینک دانلود برنامه از مایکت ", $back_key);
    
    }
    
}
if($text == "درباره ما" or $text == "درباره"){
    
    sendmessage($from_id, "درباره ما\n\n*@bomb_Source*\n\n✅ یکی از گزینه های زیر رو انتخاب کن :", $start_key);
    
}

/*
bomb_Source
*/


?>
