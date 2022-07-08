<?php
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
$token = "5455672175:AAGwnwlQUM4Q-MfoDBF4VHT5XDUtve4UKHM";//توكن
define('API_KEY',$token);
echo "https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME'];
function bot($method,$datas=[]){
return json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/$method?http_build_query($datas)"));
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id ?? $update->callback_query->message->chat->id;
$from_id = $message->from->id ?? $update->callback_query->from->id;
$text = $message->text;
$message_id = $message->message_id ?? $update->callback_query->message->message_id;
$name = $message->from->first_name ?? $update->callback_query->from->first_name;
$username = $message->from->username;
$data = $update->callback_query->data;
$admin = "5519514436";//ايدي
mkdir("data");
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
$hmo = json_decode(file_get_contents("data/hmo.json"),1);
if($text=="/start" and $from_id == $admin ){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"• اليك قائمه البوت",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- اضف قناة","callback_data"=>"chb"]],
]])
]);
unset($hmo["msg"][$from_id]);
file_put_contents("data/hmo.json",json_encode($hmo));
}
if($data == "back2"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"• اليك قائمه البوت",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- اضف قناة","callback_data"=>"chb"]],
]])
]);
unset($hmo["msg"][$from_id]);
file_put_contents("data/hmo.json",json_encode($hmo));
}
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
if($data == "chb"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"- ارسل معرف القناة",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- الغاء","callback_data"=>"back2"]],
]])
]);
$hmo["msg"][$from_id] = "ch-admin";
file_put_contents("data/hmo.json",json_encode($hmo));
}
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
if($text and $hmo["msg"][$from_id] == "ch-admin"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"- تم اضافه القناة نشر اهداء",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- رجوع","callback_data"=>"back2"]],
]])
]);
$hmo["ch"] = $text;
unset($hmo["msg"][$from_id]);
file_put_contents("data/hmo.json",json_encode($hmo));
}
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
if($text == "/start"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"-  اهلا عزيزي $name .
- في بوت اهداء اغاني 🎧 .
- ارسل اغنيتك ثم الوصف .
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"dev hmo -",'url'=>"https://t.me/d666d6"]]
]])
]);
unset($hmo["msg"][$from_id]);
file_put_contents("data/hmo.json",json_encode($hmo));
}
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
if($hmo["auto"][$from_id] == null){
if($message->voice){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"- ارسل وصف الاغنيه .
- مثل : من حمد الى مريم .
",
]);
$hmo["auto"][$from_id] = $message->voice->file_id;
$hmo["msg"][$from_id] = "hok";
file_put_contents("data/hmo.json",json_encode($hmo));
}}
elseif($hmo["auto"][$from_id] != null){
if($message->voice ){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"- انت ارسلت بصمه من قبل انتضر رد ليمكنك ارسل بصمه ثانيه",
]);
unset($hmo["msg"][$from_id]);
file_put_contents("data/hmo.json",json_encode($hmo));
}}
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
if($text and $hmo["msg"][$from_id] == "hok"){
$hmo["وصف"][$from_id] = $text;
file_put_contents("data/hmo.json",json_encode($hmo));
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- تم حفظ اهداء انتضر موافقه نشر .",
]);
bot('sendvoice',[
'chat_id'=>$admin,
'voice'=>$hmo["auto"][$from_id],
'caption'=>"- اهلا مطوري اليك اهداء جديد من شخص $nabsm
- وصف :- ".$hmo["وصف"][$from_id],
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"- موافق","callback_data"=>"/ok $from_id"],['text'=>"- رفض","callback_data"=>"/no $from_id"]],
[['text'=>'- حظر الشخص','callback_data'=>"/bn $from_id"]],
]])
]);
unset($hmo["msg"][$from_id]);
file_put_contents("data/hmo.json",json_encode($hmo));
}
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
$ok = explode('/ok ',$data)[1];
if(preg_match('/ok /', $data )){
bot('sendmessage',[
'chat_id'=>$ok,
'text'=>"- تم موافقه ع اهداء الخاص بك : "
]);
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
bot('sendvoice',[
'chat_id'=>$ok,
'voice'=>$hmo["auto"][$ok],
'caption'=>$hmo["وصف"][$ok],
]);
bot('sendvoice',[
'chat_id'=>$hmo["ch"],
'voice'=>$hmo["auto"][$ok],
'caption'=>$hmo["وصف"][$ok],
]);
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
 bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
unset($hmo["auto"][$ok]);
unset($hmo["وصف"][$ok]);
file_put_contents("data/hmo.json",json_encode($hmo));
}
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
$no = explode('/no ',$data)[1];
if(preg_match('/no /', $data )){
bot('sendmessage',[
'chat_id'=>$no,
'text'=>"- تم رفض اهداء ."
]);
 bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
unset($hmo["auto"][$no]);
unset($hmo["وصف"][$on]);
file_put_contents("data/hmo.json",json_encode($hmo));
}
$bn = explode('/bn ',$data)[1];
if(preg_match('/bn /', $data )){
bot('sendmessage',[
'chat_id'=>$bn,
'text'=>"- تم حظرك ."
]);
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- تم حظر الشخص"
]);
 bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
$hmo["المحضورين"] = $nn;
file_put_contents("data/hmo.json",json_encode($hmo));
}
/*
ملف بوت اهداء اغاني .
تخمط اذكر مصدر .
تنشر بدون مصدر اغتصبك واهينك .
كتابتي @d666d6 .
فناتي @SouRcePaTaR
*/
