<?php
ob_start();
error_reporting(0);
define('API_KEY','1611764844:AAFiE_sdGrA1YnisTZGHsXYrYajlkbeLiIM');//توکن را قرار دهید//
$admin =  "1042446145";//ایدی عددی ادمین اصلی//
$channel = "bot-nazarsanji";//ایدی کانال بدون @//
$userbot = "Google_Form1_bot";//ایدی بات بدون@//
$GetINFObot = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getMe"));
$UserNameBot = $GetINFObot->result->username;
//===============//
$telegram_ip_ranges = [
['lower' => '149.154.160.0', 'upper' => '149.154.175.255'], 
['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],    
];
$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok=false;
foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
$lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
$upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
if($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok=true;
}
if(!$ok) die("Sik :)");
define('API_KEY','توکن');//توکن را قرار دهید//
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
function SendMessage($chat_id, $text){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'MarkDown'
]);
}
function createKeyboard($string, $rows = 2, $orderBy = '|'){
$array = explode($orderBy, $string);
$arrays = array_chunk($array, $rows);
$keyboards = [];
foreach($arrays as $array){
$keyboard = [];
foreach($array as $key){
$keyboard[] = ['text'=>$key, 'callback_data'=>'data-'.$key];
}
$keyboards[] = $keyboard;
unset($keyboard);
}
return json_encode([
'inline_keyboard'=> $keyboards,
]);
}
function createKeyboardss($string1, $rows1 = 2, $orderBy1 = '|'){
$array1 = explode($orderBy1, $string1);
$arrays1 = array_chunk($array1, $rows1);
$keyboards1 = [];
foreach($arrays1 as $array1){
$keyboard1 = [];
foreach($array1 as $key1){
$keyboard1[] = ['text'=>$key1, 'callback_data'=>'data--'.$key1];
}
$keyboards1[] = $keyboard1;
unset($keyboard1);
}
return json_encode([
'inline_keyboard'=> $keyboards1,
]);
}
function objectToArrays($object){
 if(!is_object($object) && !is_array($object)){
return $object;
}
if(is_object($object)){
 $object = get_object_vars($object);
 }
return array_map("objectToArrays", $object);
 }
function save($filename, $data){
$file = fopen($filename, 'w');
fwrite($file, $data);
fclose($file);
}
function SendDocument($chat_id, $document, $caption = null){
bot('SendDocument',[
'chat_id'=>$chat_id,
'document'=>$document,
'caption'=>$caption
]);
}
function EditMessageText($chat_id,$message_id,$text,$parse_mode,$disable_web_page_preview,$keyboard){
bot('editMessagetext',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>$text,
'parse_mode'=>$parse_mode,
'disable_web_page_preview'=>$disable_web_page_preview,
'reply_markup'=>$keyboard
]);
}
 function SendVideo($chat_id,$video,$caption,$keyboard,$duration){
bot('SendVideo',[
'chat_id'=>$chatid,
'video'=>$video,
'caption'=>$caption,
'duration'=>$duration,
'reply_markup'=>$keyboard
]);
}
function SendPhoto($chat_id, $photo, $caption = null){
bot('SendPhoto',[
'chat_id'=>$chat_id,
'photo'=>$photo,
'caption'=>$caption
]);
}
function sendAction($chat_id, $action){
bot('sendChataction',[
'chat_id'=>$chat_id,
'action'=>$action]);
}
function deleteFolder($path){
if(is_dir($path) === true){
$files = array_diff(scandir($path), array('.', '..'));
foreach ($files as $file)
deleteFolder(realpath($path) . '/' . $file);
return rmdir($path);
}else if (is_file($path) === true)
return unlink($path);
return false;
}
function Forward($kojashe, $azkoja, $kodommsg){
bot('forwardmessage',[
'chat_id'=>$kojashe,
'from_chat_id'=>$azkoja,
'message_id'=>$kodommsg
]);
}
function LeaveChat($chat_id){
bot('LeaveChat',[
'chat_id'=>$chat_id
]);
}
function GetChat($chat_id){
bot('GetChat',[
'chat_id'=>$chat_id
]);
}
function AnswerCallbackQuery($callback_query_id,$text,$show_alert){
bot('answerCallbackQuery',[
'callback_query_id'=>$callback_query_id,
'text'=>$text,
'show_alert'=>$show_alert,
]);
}
function RandomString(){
$length=4;
$characters='123456789';
$string='';
for($p=0;$p<$length;$p++){
$string.=$characters[mt_rand(0,strlen($characters))];
}
return $string;
} 
//===============/
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
mkdir("data/$from_id");
$message_id = $update->message->message_id;
$text = $update->message->text;
$first_name = $update->message->from->first_name;
$last_name = $update->message->from->last_name;
$username = $update->message->from->username;
$query = $update->callback_query;
$data = $query->data;
$messageid = $query->message->message_id;
$chatid = $query->message->chat->id;
$fromid = $query->message->from->id;
$callback_query_id = $query->id;
$firstname = $update->callback_query->message->chat->first_name;
$reply = $update->message->reply_to_message;
$forward_chat_username = $update->message->forward_from_chat->username;
$da = $update->message->reply_to_message->forward_from->id;
$coin = file_get_contents("data/$chatid/coin.txt");
$state = file_get_contents("data/$chat_id/state.txt");
$step = file_get_contents("data/$from_id/step.txt");
@$list = file_get_contents("data/users.txt");
$list12 = file_get_contents("data/users.txt");
@$sea = file_get_contents("data/$from_id/membrs.txt");
@$on = file_get_contents("data/on.txt");
$idpm = file_get_contents("data/$chat_id/idpm.txt");
$to =  file_get_contents("data/$from_id/to.txt");
$blocklist = file_get_contents("data/blocklist.txt");
$members = file_get_contents('Member.txt');
$memlist = explode("\n", $members);
$member = file_get_contents("data/$from_id/member.txt");
$user = json_decode(file_get_contents('data/'.$from_id.'/data.json'));
$buytext = file_get_contents("data/buytext.txt");
$mid = file_get_contents("data/mid.txt");
$blocklist = file_get_contents("data/blocklist.txt");
$rand = file_get_contents("data/$chat_id/rand.txt");
$rand12 = file_get_contents("data/$chat_id/rand12.txt");
$listpro =  file_get_contents("pro/listpro.txt");
$listpro12 =  file_get_contents("free/listpro12.txt");
$daryafti =  file_get_contents("data/$chatid/daryafti.txt");
$created =  file_get_contents("data/created.txt");
$created12 =  file_get_contents("data/created12.txt");
$exit = objectToArrays($nms);
$key = $exit[2][0];
$exitu = objectToArrays($nmsu);
$keyu = $exitu[2][0];
$GetINFObot = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getMe"));
$UserNameBot = $GetINFObot->result->username;
$NameBot = $GetINFObot->result->first_name;
$inch = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@$channel&user_id=".$from_id);
$inch1 = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@$channel&user_id=".$chatid);
//=========//
if(strpos($blocklist, "$from_id") !== false ){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
شما به دلیل رعایت نکردن قوانین از بات بلاک شدید ❌
",
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
])
]);
}
//==========//
elseif($text=="/start"){
if(strpos($inch,'"status":"left"')== true){ 
bot('sendmessage',[
'chat_id'=>$chat_id,
'disable_web_page_preview'=>true,
'text'=>"
🚦جهت حمایت از ما و اطلاع از آپدیت های ربات در کانال ما عضو شوید!!

🚧 @$channel  ||  @$channel

🅿️ سپس به ربات برگشته و بر روی عضو شدم ✅ کلیک کنید!!
",
'parse_mode'=>"html",  
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'inline_keyboard'=>[
[['text'=>"سورس ربات",'url'=>"https://t.me/$channel"],['text'=>"عضو شدم 🛂",'url'=>"https://t.me/$userbot?start"]],
]
])
]);
}else{
bot('sendmessage', [
'chat_id' => $chat_id,
'text' => "
ʜɪ ! :) 🌹
ᴡᴇʟʟᴄᴏᴍᴇ ᴛᴏ ᴛʜᴇ sʜᴏᴘ !
به ربات فروشگاهی کانال  ما خوش آمدید 🏪
از ویترین فروشگاه دیدن فرمایید 👁‍🗨
- - - -
☑️ کانال ما :
🆔 @$channel
",
'parse_mode' => "HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'فروشگاه 🏪', 'callback_data'=>"vitrin"],['text'=>'فروشگاه رایگان 🗳', 'callback_data'=>"freepro"]],
[['text'=>'دریافتی شما 🎡', 'callback_data'=>"daryafti"],['text'=>'حساب من 🔖', 'callback_data'=>"hesab"]],
[['text'=>'پشتیبانی 👨🏻‍💻', 'callback_data'=>"sup"],['text'=>'ثبت محصول 🦚', 'callback_data'=>"sabt12"]],
],
'resize_keyboard'=>true,
])
]);
$user = file_get_contents('data/users.txt');
$members = explode("\n", $user);
if(!in_array($from_id, $members)){
$add_user = file_get_contents('data/users.txt');
$add_user .= $from_id . "\n";
file_put_contents("data/$chat_id/membrs.txt", "0");
file_put_contents("data/$chat_id/coin.txt", "0");
file_put_contents('data/users.txt', $add_user);
}
}
file_put_contents("data/$chat_id/state.txt","no");
}
//========//
elseif(strpos($text , '/start ') !== false){
$chid = str_replace("/start ","",$text);
if(strpos($inch,'"status":"left"')== true){ 
bot('sendmessage',[
'chat_id'=>$chat_id,
'disable_web_page_preview'=>true,
'text'=>"
🚦جهت حمایت از ما و اطلاع از آپدیت های ربات در کانال ما عضو شوید!!

🚧 @$channel  ||  @$channel

🅿️ سپس به ربات برگشته و بر روی عضو شدم ✅ کلیک کنید!!
",
'parse_mode'=>"html",  
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'inline_keyboard'=>[
[['text'=>"سورس ربات",'url'=>"https://t.me/$channel"],['text'=>"عضو شدم 🛂",'url'=>"https://t.me/$userbot?start=$chid"]],
]
])
]);
}else{
$user = file_get_contents('data/users.txt');
$exit = explode("\n", $user);
if($from_id != $chid){
if(!in_array($from_id,$exit) && $from_id != $chid){
$myfile2 = fopen("data/users.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$from_id\n");
fclose($myfile2);
file_put_contents("data/$chat_id/membrs.txt", "0");
file_put_contents("data/$chat_id/coin.txt", "0");
@$sho = file_get_contents("data/$chid/coin.txt");
$getsho = $sho + 1;
file_put_contents("data/$chid/coin.txt", $getsho);
@$sea = file_get_contents("data/$chid/membrs.txt");
$getsea = $sea + 1;
file_put_contents("data/$chid/membrs.txt", $getsea);
file_put_contents("data/$chat_id/state.txt","no");
bot('sendMessage',[
'chat_id'=>$chid,
'text'=>"[یک کاربر](tg://user?id=$from_id) از طریق لینک شما وارد ربات شد😍",
'parse_mode'=>"markdown",
]);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
ʜɪ ! :) 🌹
ᴡᴇʟʟᴄᴏᴍᴇ ᴛᴏ ᴛʜᴇ sʜᴏᴘ !
به ربات فروشگاهی کانال  ما خوش آمدید 🏪
از ویترین فروشگاه دیدن فرمایید 👁‍🗨
- - - -
☑️ کانال ما :
🆔 @$channel
",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'فروشگاه 🏪', 'callback_data'=>"vitrin"],['text'=>'فروشگاه رایگان 🗳', 'callback_data'=>"freepro"]],
[['text'=>'دریافتی شما 🎡', 'callback_data'=>"daryafti"],['text'=>'حساب من 🔖', 'callback_data'=>"hesab"]],
[['text'=>'پشتیبانی 👨🏻‍💻', 'callback_data'=>"sup"],['text'=>'ثبت محصول 🦚', 'callback_data'=>"sabt12"]],
],
'resize_keyboard'=>true,
])
]);
}else{
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"قبلا عضو ربات شدی دیگ نمیشه 😐❤️"
]);
}
}else{
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"وای تو چقدر باهوشی 😐😂"
]);
}
}
}
//=========//
elseif(strpos($inch1,'"status":"left"')== true){ 
 bot('answercallbackquery',[
'callback_query_id'=>$callback_query_id,
'text'=>"
⭕️شما عضو کانال ما نیستید .
/start
ارسال کنید.
",
'parse_mode'=>"html",
'show_alert'=>true,
]);
}   
//=========//
elseif($data == "freepro"  ){
if($created12 == "ok"){
file_put_contents("data/$chatid/state.txt","none");
$listpro12 =  file_get_contents("free/listpro12.txt");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
لیست محصولات فروشگاه به شرح زیر میباشد 🍿
",
'parse_mode'=>"html",  
'reply_markup'=>createKeyboard(file_get_contents("free/listpro12.txt"),'2',"\n")
]);
}else{
bot('answercallbackquery',[
'callback_query_id'=>$callback_query_id,
'text'=>"محصولی در فروشگاه وجود ندارد 🚧",
]);
}
}
elseif(strpos($text,"/free_" ) !== false ){
$exitu = explode("_",$text);
$key21 = $exitu[1];
$proname12 = file_get_contents("free/$key21/proname12.txt");
$expro12 = file_get_contents("free/$key21/expro12.txt");
$dlfile12 = file_get_contents("free/$key21/dlfile12.txt");
bot('senddocument',[
'chat_id'=>$chat_id,
'document'=>$dlfile12,
'caption'=>"
💠نام محصول : $proname12

📝 توضیحات : $expro12

🧾 کد محصول : $key21

💎 کانال ما :
🧧@$channel
",
'parse_mode' => "HTML",
]);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
این محصول رایگان میباشد 💡
",
'parse_mode' => "HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
//=========//
elseif($data == "vitrin" ){
if($created == "ok"){
file_put_contents("data/$chatid/state.txt","none");
$listpro =  file_get_contents("pro/listpro.txt");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
لیست محصولات فروشگاه به شرح زیر میباشد 🍿
",
'parse_mode'=>"html",  
'reply_markup'=>createKeyboardss(file_get_contents("pro/listpro.txt"),'2',"\n")
]);
}else{
bot('answercallbackquery',[
'callback_query_id'=>$callback_query_id,
'text'=>"محصولی در فروشگاه وجود ندارد 🚧",
]);
}
}
elseif(strpos($data,"data--" ) !== false ){
preg_match_all("/data--(.*)-(.*)/",$data,$nms);
$exit = objectToArrays($nms);
$key = $exit[2][0];
bot('editMessagetext', [
'chat_id' => $chatid,
'message_id'=>$messageid,
'text' => "
🔖برای دریافت اطلاعات بیشتر در مورد محصول دریافتی بر روی دکمه زیر بزنید.

📂  /info_$key

💾 در غیر این صورت محصول دیگری از منوی زیر انتخاب کنید .
",
'parse_mode' => "HTML",
'reply_markup'=>createKeyboardss(file_get_contents("pro/listpro.txt"),'2',"\n")
]);
}
elseif(strpos($data,"data-" ) !== false ){
preg_match_all("/data-(.*)--(.*)/",$data,$nmsu);
$exitu = objectToArrays($nmsu);
$keyu = $exitu[2][0];
bot('editMessagetext', [
'chat_id' => $chatid,
'message_id'=>$messageid,
'text' => "
🔖برای دریافت اطلاعات بیشتر در مورد محصول دریافتی بر روی دکمه زیر بزنید.

📂  /free_$keyu

💾 در غیر این صورت محصول دیگری از منوی زیر انتخاب کنید .
",
'parse_mode' => "HTML",
'reply_markup'=>createKeyboard(file_get_contents("free/listpro12.txt"),'2',"\n")
]);
}
elseif(strpos($text,"/info_" ) !== false ){
$exit = explode("_",$text);
$key20 = $exit[1];
$proname1 = file_get_contents("pro/$key20/proname.txt");
$expro1 = file_get_contents("pro/$key20/expro.txt");
$sekpro1 = file_get_contents("pro/$key20/sekpro.txt");
$polpro1 = file_get_contents("pro/$key20/polpro.txt");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
💠نام محصول : $proname1

📝 توضیحات : $expro1

📤 سکه لازم برای دریافت : $sekpro1

💰قیمت محصول : $polpro1 تومان

🧾 کد محصول : $key20
",
'parse_mode' => "HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"دریافت محصول 🚦",'callback_data'=>"send|$key20"],['text'=>"خرید محصول 💰",'url'=>"https://t.me/$mid"]],
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif(strpos($data,"send|" ) !== false ){
$exit = explode("|",$data);
$key1 = $exit[1];
$sekpro2 = file_get_contents("pro/$key1/sekpro.txt");
$coin = file_get_contents("data/$chatid/coin.txt");
if($coin >= $sekpro2){
$proname2 = file_get_contents("pro/$key1/proname.txt");
$expro2 = file_get_contents("pro/$key1/expro.txt");
$dlfile2 = file_get_contents("pro/$key1/dlfile.txt");
$coin = file_get_contents("data/$chatid/coin.txt");
$sekpro2 = file_get_contents("pro/$key1/sekpro.txt");
settype($coin,"integer");
$newcoin = $coin - $sekpro2;
file_put_contents("data/$chatid/coin.txt","$newcoin");
bot('senddocument',[
'chat_id'=>$chatid,
'document'=>$dlfile2,
'caption'=>"
💠نام محصول : $proname2

📝 توضیحات : $expro2

💡 کانال ما :
🆔 @$channel
",
'parse_mode' => "HTML",
]);
bot('sendmessage',[
'chat_id'=>$chatid,
'text'=>"
شما محصول با کد $key1 را دریافت کردید ✅

تعداد $sekpro2 از حساب شما کسر شد 💁🏻‍♂
شات ل
",
'parse_mode' => "HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
$rnd = RandomString();
mkdir("data/$chatid/$rnd");
file_put_contents("data/$chatid/$rnd/dluserr.txt","$dlfile2");
$listprouser =  file_get_contents("data/$chatid/listprouser.txt");
$myfile1 = fopen("data/$chatid/listprouser.txt", "a") or die("Unable to open file!");
fwrite($myfile1, "$proname2|/dl_$rnd \n");
fclose($myfile1);
file_put_contents("data/$chatid/daryafti.txt","ok");
file_put_contents("data/$chatid/state.txt","none");
}else{
file_put_contents("data/$chatid/step.txt","none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
❌ سکه شما جهت دریافت محصول کافی نمیباشد.
🔰تعداد سکه شما : $coin
✅ از بخش حساب کاربری سکه تو افزایش بده.
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
}
//==========//
elseif($data == "back" ){
file_put_contents("data/$chatid/state.txt","none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
ʜɪ ! :) 🌹
ᴡᴇʟʟᴄᴏᴍᴇ ᴛᴏ ᴛʜᴇ sʜᴏᴘ !
به ربات فروشگاهی کانال  ما خوش آمدید 🏪
از ویترین فروشگاه دیدن فرمایید 👁‍🗨
- - - -
☑️ کانال ما :
🆔 @$channel
",
'parse_mode'=>"html",  
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'فروشگاه 🏪', 'callback_data'=>"vitrin"],['text'=>'فروشگاه رایگان 🗳', 'callback_data'=>"freepro"]],
[['text'=>'دریافتی شما 🎡', 'callback_data'=>"daryafti"],['text'=>'حساب من 🔖', 'callback_data'=>"hesab"]],
[['text'=>'پشتیبانی 👨🏻‍💻', 'callback_data'=>"sup"],['text'=>'ثبت محصول 🦚', 'callback_data'=>"sabt12"]],
],
'resize_keyboard'=>true,
])
]);
}
//==========//
elseif($data == "daryafti"){
if($daryafti == "ok"){
$listprouser =  file_get_contents("data/$chatid/listprouser.txt");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
🧧 محصولات دریافتی شما به شرح زیر میباشد .

نام محصول 🌿 | کد محصول 🧾

$listprouser
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}else{
bot('answercallbackquery',[
'callback_query_id'=>$callback_query_id,
'text'=>"شما محصولی تا حالا دریافت نکردید 🚫",
]);
}
}
elseif(strpos($text,"/dl_" ) !== false ){
$exit = explode("_",$text);
$keyu = $exit[1];
$dluserr =  file_get_contents("data/$chat_id/$keyu/dluserr.txt");
bot('senddocument',[
'chat_id'=>$chat_id,
'document'=>$dluserr,
'caption'=>"",
]);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
فایل شما 👆🏻
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
//=========//
elseif(strpos($blocklist, "$chatid") !== false){
bot('answercallbackquery',[
'callback_query_id'=>$callback_query_id,
'text'=>"شما از بات بلاک شده اید 😐",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'KeyboardRemove'=>[],'remove_keyboard'=>true
])
]);
}
//=========//
elseif($data == "hesab" ){
file_put_contents("data/$chatid/state.txt","none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
به بخش حساب کاربری خود خوش آمدید 🔑
",
'parse_mode'=>"html",  
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'وضعیت 💎', 'callback_data'=>"pos"],['text'=>'خرید سکه 💰','callback_data'=>"buy"]],
[['text'=>'افزایش سکه 🔋','callback_data'=>"banner"],['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($data == "banner" ){
file_put_contents("data/$chatid/state.txt","none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
📷 برای دریافت بنر زیر مجموعه گیری بر روی دکمه اشتراک گزاری زیر بزنید .

⭕️ یا میتوانید در هر جا با استفاده از متن زیر بنر خود را دریافت کنید.

💿<pre>@$UserNameBot inline_banner</pre>
",
'parse_mode'=>"html",  
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"اشتراک گزاری 📌",'switch_inline_query'=>"inline_banner"]],
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif(isset($update->inline_query) and $update->inline_query->query == 'inline_banner'){
bot('answerInlineQuery',array(
'inline_query_id' => $update->inline_query->id,
'cache_time' => 1,
'results' => json_encode(array(array(
'type' => 'article',
'id' => base64_encode(rand(0,999)),
'thumb_url' => '',
'title' => 'بیع یه چیزی بگمت',
'parse_mode'=> 'MarkDown',
'input_message_content' => array('parse_mode' => 'html', 'message_text' => '
برو تو رباتش شک نکن ضرر نمیکنی !!
')),array(
'type' => 'photo',
'id' => base64_encode(rand(0,999)),
'photo_url' => 'http://uupload.ir/files/nnyp_psx_20200302_022029.jpg',
'thumb_url' => 'http://uupload.ir/files/nnyp_psx_20200302_022029.jpg',
'caption' => '
🛍 ربات فروشگاهی آنلاین

💡 دارای بخش رایگان محصولات
💎 خرید پکیج های آموزشی
🧾 محصولات پاپ نشده 
🧸 دریافت روزانه محصولات رایگان
🏪 فروشگاه آنلاین 24 ساعته

🔑 اگه میخوای همه اینارو داشته باشی فقط ربات زیر رو استارت کن!!!

🔗https://t.me/'.bot('GetMe')->result->username.'?start='.$update->inline_query->from->id,
'title' => 'برای اشتراک گذاشتن بنر روی عکس زیر کلیک کنید',
'reply_markup' => array('inline_keyboard'=>array(
array(array('text'=>'اشتراک گذاری📌','switch_inline_query'=>'inline_banner'))
))
)
))
));
}
//===========//
elseif($data == "sabt12" ){
file_put_contents("data/$chatid/state.txt","none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
🛍شما میتوانید جهت ثبت محصول خود در ربات با مدیر در ارتباط باشید.
",
'parse_mode'=>"html",  
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"ارتباط با مدیر 💁🏻‍♂",'url'=>"t.me/$mid"]],
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
//==========//
elseif($data =="sup"){
file_put_contents("data/$chatid/state.txt","mok");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"لطفا نظر،پیشنهاد و مشکل خود را اِرسال کنید 👇🏻",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($state == "mok"){
file_put_contents("data/$chat_id/state.txt","no");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"
💡مدیر  یک پیام با اطلاعات زیر داری:
نام کاربر : $firstname
ایدی کاربر: @$username
ایدی عددی کاربر : <pre>$from_id</pre>
🚦 متن پیام :
- - - - - - - - - - - -
$text
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"پاسخ به کاربر 💡",'callback_data'=>"pm|$from_id"]],
],
'resize_keyboard'=>true,
])
]);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"ارسال شد ✅",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif(strpos($data,"pm|" ) !== false ){
$exit = explode("|",$data);
$key = $exit[1];
file_put_contents("data/$chatid/info.txt","$key");
file_put_contents("data/$chatid/state.txt","pm1");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"
شما در حال پاسخ به ایدی $key هستید 🛡
",
'parse_mode'=>'html',
]);
}
elseif($state == "pm1"){
file_put_contents("data/$from_id/sendpm.txt","$text");
file_put_contents("data/$chat_id/state.txt","no");
$info = file_get_contents("data/$from_id/info.txt");
$sendpm = file_get_contents("data/$from_id/sendpm.txt");
bot('sendMessage',[
'chat_id'=>$info,
 'text'=>"
 پاسخ پیام شما از پشتیبانی 🎙
- - - - - - - - - - - -
$sendpm
",
'parse_mode'=>'MarkDown',
]);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"ارسال شد ✅",
]);
}
//==========//
elseif($data == "pos" ){
file_put_contents("data/$chatid/state.txt","none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
وضعیت حساب شما به شرح زیر میباشد 💡
",
'parse_mode'=>"html",  
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"نام شما 🎖",'callback_data'=>"BotSorce"],['text'=>"[ $firstname ]",'callback_data'=>"BotSorce"]],
[['text'=>"ایدی عددی 🎗",'callback_data'=>"BotSorce"],['text'=>"[ $chatid ]",'callback_data'=>"BotSorce"]],
[['text'=>"تعداد سکه 🍫",'callback_data'=>"BotSorce"],['text'=>"[ $coin ]",'callback_data'=>"BotSorce"]],
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
//==========//
elseif($data == "buy" ){
file_put_contents("data/$chatid/state.txt","none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
$buytext
",
'parse_mode'=>"html",  
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"ارتباط با مدیر 💁🏻‍♂",'url'=>"t.me/$mid"]],
[['text'=>"برگشت ↩️",'callback_data'=>"back"]],
],
'resize_keyboard'=>true,
])
]);
}
//==========//
elseif($data=="BotSorce"){
file_put_contents("data/$from_id/step.txt","none");
bot('answercallbackquery',[
'callback_query_id'=>$callback_query_id,
'text'=>"این دکمه صرفا نمایشی است ❗️",
]);
}
//=========//
elseif($text == "/panel"  && $chat_id == $admin){
bot('sendmessage', [
'chat_id' =>$chat_id,
'text' =>"به پنل مدیریتی ربات فروشگاهی خوش آمدید ⛳️",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'آمار 🔖' , 'callback_data'=>"amar"],['text'=>'مدیریت محصول 🏪' , 'callback_data'=>"sabt"]],
[['text'=>'پیام همگانی 📬' , 'callback_data'=>"pmall"],['text'=>'فورارد همگانی 🗃' , 'callback_data'=>"forall"]],
[['text'=>'متن فروش سکه 🏟' , 'callback_data'=>"textsek"],['text'=>'تنظیم ایدی مدیر 👨🏻‍💻' , 'callback_data'=>"idmodir"]],
[['text'=>'سکه به کاربر 💰' , 'callback_data'=>"score"],['text'=>'صفر کردن سکه 🚯' , 'callback_data'=>"sefr"]],
[['text'=>'راهنمای ربات 🎩' , 'callback_data'=>"rah"],['text'=>'سکه همگانی 💡' , 'callback_data'=>"scoreall"]],
[['text'=>'بلاک کردن 🔫' , 'callback_data'=>"block"],['text'=>'آنبلاک کردن 🔪' , 'callback_data'=>"unblock"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "2" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"به پنل مدیریتی ربات فروشگاهی خوش آمدید ⛳️",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'آمار 🔖' , 'callback_data'=>"amar"],['text'=>'مدیریت محصول 🏪' , 'callback_data'=>"sabt"]],
[['text'=>'پیام همگانی 📬' , 'callback_data'=>"pmall"],['text'=>'فورارد همگانی 🗃' , 'callback_data'=>"forall"]],
[['text'=>'متن فروش سکه 🏟' , 'callback_data'=>"textsek"],['text'=>'تنظیم ایدی مدیر 👨🏻‍💻' , 'callback_data'=>"idmodir"]],
[['text'=>'سکه به کاربر 💰' , 'callback_data'=>"score"],['text'=>'صفر کردن سکه 🚯' , 'callback_data'=>"sefr"]],
[['text'=>'راهنمای ربات 🎩' , 'callback_data'=>"rah"],['text'=>'سکه همگانی 💡' , 'callback_data'=>"scoreall"]],
[['text'=>'بلاک کردن 🔫' , 'callback_data'=>"block"],['text'=>'آنبلاک کردن 🔪' , 'callback_data'=>"unblock"]],
],
'resize_keyboard'=>true
])
]);
}
//========//
elseif($data == "rah" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
💾 راهنمای ربات فروشگاهی آنلاین

💯 لطفا مراحل زیر را به دقت اجرا کنید تا ربات به درستی کار شود.

1⃣  ابتدا لازم است ایدی مدیر و متن فروش سکه را تنظیم نمایید.

2⃣ برای اینکه بنر ربات فروشگاهی کار کند شما باید در @botfather به بخش botsetting رفته و حالت inline mode را در حالت on روشن قرار بدید سپس در همان بخش inline feedback را روی 100 درصد بزارید با این کار بنر اینلاین ربات شما فعال میشود.

3⃣ در هنگام ثبت محصولات استفاده از نام های طولانی در نام محصول خودداری فرمایید.

4⃣ در هنگام ثبت محصول فقط از فایل های Zip استفاده کنید تا به درستی محصول ثبت شود.

5⃣ شما میتوانید با ویژه شدن تبلیغات در ربات خود را حذف کنید.
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "sabt" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"به بخش ثبت محصول خوش آمدید 🌹",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'محصول ویژه ⭐️' , 'callback_data'=>"sabtnew"],['text'=>'حذف محصول ویژه 🌓' , 'callback_data'=>"delsabt"]],
[['text'=>'محصول رایگان 🔑' , 'callback_data'=>"freepro13"],['text'=>'حذف محصول رایگان 📮' , 'callback_data'=>"delprofree"]],
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "delprofree" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
از منوی زیر انتخاب کنید 🌼
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'حذف' , 'callback_data'=>"delsabt12"],['text'=>'حذف کلی محصولات' , 'callback_data'=>"hafiiall12"]],
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "hafiiall12" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
unlink("free/listpro12.txt");
file_put_contents("data/created12.txt","no");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
تمامی محصولات رایگان حذف شدند 🌿
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "delsabt12" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
لیست محصولات رایگان فروشگاه به شرح زیر میباشد.

<pre>$listpro12</pre>

✅برای حذف محصول مورد نظر کافی است محصولی را که میخواهید حذف کنید را از لیست بالا پاک کنید و آن را بفرستید.

Ⓜ️برای مثال اگر لیست شما به صورت زیر بود:

سورس--123
مترجم--455
ویدیو--788

ℹ️برای حذف مترجم--455 کافی است آن را از لیست پاک کنید و لیست جدید که به شکل زیر است را ارسال کنید.

سورس--123
ویدیو--788

حتما باید هر کدام از محصولات در یک خط باشند . در این صورت مترجم--455 حذف میشود.
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'حذف ❌' , 'callback_data'=>"hafii12"]],
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "hafii12" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","delli12");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"برای حذف کافی است مطابق مثال لیست جدید را بفرستید 📝",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "delli12"){
file_put_contents("free/listpro12.txt","$text");
bot('Sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
محصولات جدید رایگان با لیست
  $text 
با موفقیت اضافه شدند✅
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($data == "freepro13" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
به بخش محصول جدید رایگان خوش آمدید 🧩

💐 توجه کنید این محصول در بخش رایگان قرار میگیرد و دریافت آن برای عموم آزاد میباشد.

🚧 در این بخش از شما تعدادی اطلاعات گرفته خواهد شد لطفا به آن ها به دقت پاسخ دهید .

🚢 برای شروع بر روی دکمه زیر بزنید.
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'شروع 🍷' , 'callback_data'=>"startnewff"]],
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "startnewff" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "proname12");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
📱 مرحله اول : 
📀 نام محصول را ارسال کنید!!!

",
'parse_mode'=>'html',
]);
}
elseif($step == "proname12"){
$rand12 = RandomString();
mkdir("free/$rand12");
file_put_contents("data/$chat_id/rand12.txt","$rand12");
file_put_contents("free/$rand12/proname12.txt","$text");
file_put_contents("data/$chat_id/step.txt","expro12");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
نام محصول $text ثبت شد ✅

💎مرحله دوم :
 توضیحاتی در مورد محصول مورد نظر ارسال کنید.
",
]);
}
elseif($step == "expro12"){
$rand12 = file_get_contents("data/$chat_id/rand12.txt");
file_put_contents("free/$rand12/expro12.txt","$text");
file_put_contents("data/$chat_id/step.txt","file12");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
توضیحات محصول ($text) ثبت شد ✅

⭕️ مرحله سوم : فایل هایی که قرار است با این محصول باشد را به صورت فایل (zip) شده بفرستید..

⚠️ حتما باید به صورت فایل Zip شده باشد .

🚸 درون فایل Zip هر فایلی که دارید میتونید قرار بدید..

🔰 حالا فایل Zip شده محصول را بفرستید..
",
]);
}
elseif($step == "file12"){
file_put_contents("data/$chat_id/step.txt","no");
$rand12 = file_get_contents("data/$chat_id/rand12.txt");
$document = $message->document;
$file12 = $document->file_id;
file_put_contents("free/$rand12/dlfile12.txt","$file12");
$dlfile12 = file_get_contents("free/$rand12/dlfile12.txt");
$proname12 = file_get_contents("free/$rand12/proname12.txt");
$expro12 = file_get_contents("free/$rand12/expro12.txt");
$listpro12 =  file_get_contents("free/listpro12.txt");
file_put_contents("data/created12.txt","ok");
$myfile12 = fopen("free/listpro12.txt", "a") or die("Unable to open file!");
fwrite($myfile12, "$proname12--$rand12 \n");
fclose($myfile12);
bot('senddocument',[
'chat_id'=>$admin,
'document'=>$dlfile12,
'caption'=>"
💠نام محصول : $proname12

📝 توضیحات : $expro12
",
]);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
پیام بالا پیش نمایش محصول میباشد.

✅ محصول بالا رو فرستادم به بخش فروشگاه رایگان
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($data == "delsabt" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
از منوی زیر انتخاب کنید 🌼
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'حذف ❌' , 'callback_data'=>"delsabt1"],['text'=>'حذف کلی محصولات 🪐' , 'callback_data'=>"hafiiall"]],
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "hafiiall" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
unlink("pro/listpro.txt");
file_put_contents("data/created.txt","no");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
تمامی محصولات ویژه حذف شدند 🌿
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "delsabt1" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
لیست محصولات فروشگاه به شرح زیر میباشد.

<pre>$listpro</pre>

✅برای حذف محصول مورد نظر کافی است محصولی را که میخواهید حذف کنید را از لیست بالا پاک کنید و آن را بفرستید.

Ⓜ️برای مثال اگر لیست شما به صورت زیر بود:

سورس-123
مترجم-455
ویدیو-788
ش 
ا 
تل

ℹ️برای حذف مترجم-455 کافی است آن را از لیست پاک کنید و لیست جدید که به شکل زیر است را ارسال کنید.

سورس-123
ویدیو-788

حتما باید هر کدام از محصولات در یک خط باشند . در این صورت مترجم-455 حذف میشود.
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'حذف ❌' , 'callback_data'=>"hafii"]],
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "hafii" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","delli");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"برای حذف کافی است مطابق مثال لیست جدید را بفرستید 📝",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "delli"){
file_put_contents("pro/listpro.txt","$text");
bot('Sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
محصولات جدید با لیست
  $text 
با موفقیت اضافه شدند✅
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($data == "sabtnew" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "none");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
به بخش محصول جدید خوش آمدید 🧩

🚧 در این بخش از شما تعدادی اطلاعات گرفته خواهد شد لطفا به آن ها به دقت پاسخ دهید .

🚢 برای شروع بر روی دکمه زیر بزنید.
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'شروع 🏭' , 'callback_data'=>"startnew"]],
[['text'=>'برگشت ↩️' , 'callback_data'=>"2"]],
],
'resize_keyboard'=>true
])
]);
}
elseif($data == "startnew" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt", "proname");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"
📱 مرحله اول : 
📀 نام محصول را ارسال کنید!!!
",
'parse_mode'=>'html',
]);
}
elseif($step == "proname"){
$rand = RandomString();
mkdir("pro/$rand");
file_put_contents("data/$chat_id/rand.txt","$rand");
file_put_contents("pro/$rand/proname.txt","$text");
file_put_contents("data/$chat_id/step.txt","expro");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
نام محصول $text ثبت شد ✅

💎مرحله دوم :
 توضیحاتی در مورد محصول مورد نظر ارسال کنید.
",
]);
}
elseif($step == "expro"){
$rand = file_get_contents("data/$chat_id/rand.txt");
file_put_contents("pro/$rand/expro.txt","$text");
file_put_contents("data/$chat_id/step.txt","polpro");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
توضیحات محصول ($text) ثبت شد ✅

🦋 مرحله سوم : قیمت محصول را وارد کنید .
به تومان🎩
مثال:
5000
",
]);
}
elseif($step == "polpro"){
$rand = file_get_contents("data/$chat_id/rand.txt");
file_put_contents("pro/$rand/polpro.txt","$text");
file_put_contents("data/$chat_id/step.txt","sekpro");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
قیمت محصول ($text هزار تومان) ثبت شد ✅

🔰مرحله چهارم : تعداد سکه لازم(به عدد لاتین) برای دریافت محصول را وارد کنید.
",
]);
}
elseif($step == "sekpro"){
$rand = file_get_contents("data/$chat_id/rand.txt");
file_put_contents("pro/$rand/sekpro.txt","$text");
file_put_contents("data/$chat_id/step.txt","file");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
تعدا سکه برای دریافت ($text) ثبت شد✅

⭕️ مرحله پنجم : فایل هایی که قرار است با این محصول باشد را به صورت فایل (zip) شده بفرستید..

⚠️ حتما باید به صورت فایل Zip شده باشد .

🚸 درون فایل Zip هر فایلی که دارید میتونید قرار بدید..

🔰 حالا فایل Zip شده محصول را بفرستید..
",
]);
}
elseif($step == "file"){
file_put_contents("data/$chat_id/step.txt","no");
$rand = file_get_contents("data/$chat_id/rand.txt");
$document = $message->document;
$file = $document->file_id;
file_put_contents("pro/$rand/dlfile.txt","$file");
$dlfile = file_get_contents("pro/$rand/dlfile.txt");
$proname = file_get_contents("pro/$rand/proname.txt");
$expro = file_get_contents("pro/$rand/expro.txt");
$sekpro = file_get_contents("pro/$rand/sekpro.txt");
$polpro = file_get_contents("pro/$rand/polpro.txt");
file_put_contents("data/created.txt","ok");
$listpro =  file_get_contents("pro/listpro.txt");
$myfile1 = fopen("pro/listpro.txt", "a") or die("Unable to open file!");
fwrite($myfile1, "$proname-$rand \n");
fclose($myfile1);
bot('senddocument',[
'chat_id'=>$admin,
'document'=>$dlfile,
'caption'=>"
💠نام محصول : $proname

📝 توضیحات : $expro

📤 سکه لازم برای دریافت : $sekpro

💰قیمت محصول : $polpro تومان

🧾 کد محصول : $rand

🎗کانال ما :
🆔 @$channel
",
]);
$channel = "xxxxxxxx";//کانال خود را جایگزین کنید
bot('sendmessage',[
'chat_id'=>"@".$channel,
'text'=>"
محصول جدیدی در ربات فروشگاهی ساخته شد ✅

💠نام محصول : $proname

📝 توضیحات : $expro

📤 سکه لازم برای دریافت : $sekpro

💰قیمت محصول : $polpro تومان

🎗کانال ما :
🆔 @$channel
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'دریافت محصول 📥', 'url'=>"https://t.me/$UserNameBot"]],
],
'resize_keyboard'=>true,
])
]);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
پیام بالا پیش نمایش محصول میباشد.

✅ محصول بالا رو فرستادم به کانال و ویترین فروشگاه.
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
//===========//
elseif($data == "idmodir"  && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","texto");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"ایدی ارتباط با مدیر را بدون @ ارسال کنید.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "texto"){
file_put_contents("data/mid.txt",$text);
file_put_contents("data/$chat_id/step.txt","no");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تنظیم شد.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}

elseif($data == "textsek"  && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","textok");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"متن فروش سکه را ارسال کنید.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "textok"){
file_put_contents("data/buytext.txt",$text);
file_put_contents("data/$chat_id/step.txt","no");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تنظیم شد.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
//==========//
elseif($data == "off" && $chatid == $admin){
if($on != "off"){
file_put_contents("data/on.txt","off");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"🎭 ربات خاموش شد",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}else{
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text' =>"ربات از قبل خاموش بود...",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
}
//========//
elseif($data == "unblock" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","sharr");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"لطفا ایدی عددی کاربر مورد نظر رو ارسال کنید",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "sharr"){
file_put_contents("data/$chat_id/step.txt", "none");
$newlist = str_replace($text, "", $blocklist);
file_put_contents("data/blocklist.txt", $newlist);
bot('Sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
خب ایدی $text از بلاکی درآمد 😎
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
bot('Sendmessage',[
'chat_id'=>$text,
'text'=>"
ارتباط شما با سرور برقرار شد و میتوانید از بات استفاده کنید 😻
",
]);
}
//===
elseif($data == "block" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","shar");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"لطفا ایدی فرد مورد نظر را ارسال کنید",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "shar"){
file_put_contents("data/$chat_id/step.txt", "none");
file_put_contents("data/$from_id/shar.txt","$text");
bot('Sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
ایدی $text از ربات بلاک شد
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
$adduser = file_get_contents("data/blocklist.txt");
$adduser .= $text . "\n";
file_put_contents("data/blocklist.txt", $adduser);
$id11 = file_get_contents("data/$from_id/shar.txt");
bot('Sendmessage',[
'chat_id'=>$id11,
'text'=>"ارتباط شما با سرور ما قطع شد و نمیتوانید از بات استفاده کنید 😹",
]);
}
//===========//
elseif($data == 'scoreall' && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","scoreall");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"تعداد سکه همگانی را وارد کنید",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "scoreall"){
$mem = file_get_contents("data/users.txt");
$Member = explode("\n",$mem);
$count = count($Member)-2;
for($z = 0;$z <= $count;$z++){
$user = $Member[$z];
$cn = file_get_contents("data/$user/coin.txt");
$newham = $cn+$text ;
file_put_contents("data/$user/coin.txt",$newham);
file_put_contents("data/$chat_id/step.txt","no");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تعداد $text سکه همگانی به کاربران ارسال شد",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
bot('sendmessage',[
'chat_id'=>$user,
'text'=>"
#سکه_همگانی
☑️از طرف مدیر تعداد $text سکه به حساب شما افزوده شد.
",
]);
}
}
//==========//
elseif($data == "sefr" && $chatid ==$admin){
file_put_contents("data/$chatid/step.txt","em0");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"👩‍💻 لطفا آیدی عددی کاربری که میخواهید تعداد امتیازات او را 0 را ارسال کنید :",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "em0"){
file_put_contents("data/$chat_id/step.txt","none");
$aad = file_get_contents("data/$text/coin.txt");
file_put_contents("data/$text/coin.txt","0");
bot('Sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
🔪 امتیاز های او صفر شد
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
bot('Sendmessage',[
'chat_id'=>$text,
'text'=>"🔥امتیازات شما به دلیل آوردن زیرمجموعه فیک حذف شدند!",
]);
}
//==========//
elseif($data== "score" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","fromidforcoin");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"لطفا ایدی فرد مورد نظر را ارسال کنید",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "fromidforcoin"){
file_put_contents("data/$chat_id/step.txt","tedadecoin4set");
file_put_contents("data/$from_id/to.txt",$text);
$coin = file_get_contents("data/$text/coin.txt");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text' =>"
💰تعداد سکه کاربر : $coin
💡چند سکه به کاربر ارسال کنم ؟
",
]);
}
elseif($step == "tedadecoin4set"){
file_put_contents("data/$chat_id/step.txt","none");
$coin = file_get_contents("data/$to/coin.txt");
settype($coin,"integer");
$newcoin = $coin + $text;
file_put_contents("data/$to/coin.txt",$newcoin);
$cooin = $coin + $text;
bot('sendmessage', [
'chat_id' => $admin,
'text' =>"
تعداد $text سکه افزوده شد 🔋
💎تعداد کل سکه کاربر : $cooin
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
bot('sendmessage',[
'chat_id' => $to,
'text' =>"
تعداد $text سکه به حساب شما افزوده شد ✅
تعداد کل سکه شما 💰 : $cooin
",
]);
}
//===========//
elseif($data == 'forall' && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","fortoall");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"لطفا متن خود را فوروارد کنید 🚀",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == 'fortoall' ){
file_put_contents("data/$chat_id/step.txt","no");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پیام با موفقیت ارسال شد✔️",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
$mem = fopen( "data/users.txt", 'r');
while(!feof($mem)){
$memuser = fgets($mem);
Forward($memuser, $chat_id,$message_id);
}
}

elseif($data == "pmall" && $chatid == $admin){
file_put_contents("data/$chatid/step.txt","pmh");
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"پیام خود را ارسال کنید",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}
elseif($step == "pmh" ){
file_put_contents("data/$chat_id/step.txt","none");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پیام شما فرستاده شد 💫",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
$all_member = fopen( "data/users.txt", "r");
while( !feof( $all_member)){
$user = fgets( $all_member);
SendMessage($user,$text,"html");
}
}
//==========//
elseif($data == "amar" && $chatid == $admin){
$user = file_get_contents("data/users.txt");
$member_id = explode("\n",$user);
$member_count = count($member_id) -1;
bot('editMessagetext',[
'chat_id'=>$chatid,
'message_id'=>$messageid,
'text'=>"
🎩 Amar ::: $member_count
",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'برگشت ↩️', 'callback_data'=>"2"]],
],
'resize_keyboard'=>true,
])
]);
}

?>
