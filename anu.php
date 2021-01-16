<?php
$BOT_TOKEN = "1409547177:AAGo_W5b6-WzquQ6MR82xy3lIfPzL4ia4UI";

//---! Variable Biar enggak panjang !---\\
$update = file_get_contents('php://input');
$update = json_decode($update, true);
$msg = $update["message"]?$update["message"]:null;
$channel = $update["channel_post"]?$update["channel_post"]:null;
$msgr = $msg["reply_to_message"]?$msg["reply_to_message"]:null;
$userMessage = $update["message"]["text"]?$update["message"]["text"]:"Nothing";
$firstName = $update["message"]["from"]["first_name"]?$update["message"]["from"]["first_name"]:"";
$lastName = $update["message"]["from"]["last_name"]?$update["message"]["from"]["last_name"]:"";
$fullName = $firstName." ".$lastName;
$usernamebot = "fuadazkabot";

//---! start message !---\\
if (preg_match('/start/i', $channel["text"])){
    $parameters = array(
        "chat_id" => $channel["chat"]["id"],
        "text" => "hello ",
        "parseMode" => "html",
        "reply_to_message_id" => $msg["message_id"],
    );
    send("sendMessage", $parameters);
}

//---! start message !---\\
if (preg_match('/start/i', $msg["text"])){
    $parameters = array(
        "chat_id" => $msg["chat"]["id"],
        "text" => "hello ".$fullName." Perkenalkan nama saya @".$usernamebot."\nwork",
        "parseMode" => "html",
        "reply_to_message_id" => $msg["message_id"],
    );
    send("sendMessage", $parameters);
}

//---! send photo !---\\
if (preg_match('/poto/i', $msg["text"])){
    $parameters = array(
        "chat_id" => $msg["chat"]["id"],
        "photo" => "https://telegra.ph/file/44cb191a5d03ffad95cdc.jpg",
        "caption" => "ini foto",
        "parseMode" => "html",
    );
    send("sendPhoto", $parameters);
}

//---! send video !---\\
if (preg_match('/video/i', $msg["text"])){
    $parameters = array(
        "chat_id" => $msg["chat"]["id"],
        "video" => "https://telegra.ph/file/036bb217a6470709f2f62.mp4",
        "caption" => "ini video",
        "parseMode" => "html",
    );
    send("sendVideo", $parameters);
}

function send($method, $data){
    global $BOT_TOKEN;
    $url = "https://api.telegram.org/bot$BOT_TOKEN/$method";

    if(!$curld = curl_init()){
        exit;
    }
    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curld);
    curl_close($curld);
    return $output;
}

?>